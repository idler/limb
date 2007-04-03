<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbTreeRsProcessor.class.php 5517 2007-04-03 10:20:44Z serega $
 * @package    tree
 */
lmb_require('limb/datasource/src/lmbPagedArrayDataset.class.php');

class lmbTreeRsProcessor
{
  function sort($rs, $sort_params, $id_hash = 'id', $parent_hash = 'parent_id')
  {
    $tree_array = self :: _convertRs2Array($rs);

    $item = reset($tree_array);
    $parent_id = $item[$parent_hash];

    $sorted_tree_array = array();

    self :: _doSort($tree_array, $sorted_tree_array, $sort_params, $parent_id, $id_hash, $parent_hash);

    return new lmbPagedArrayDataset($sorted_tree_array);
  }

  function _convertRs2Array($rs)
  {
    $tree_array = array();
    foreach($rs as $record)
      $tree_array[] = $record;

    return $tree_array;
  }

  function _doSort($tree_array, &$sorted_tree_array, $sort_params, $parent_id, $id_hash, $parent_hash)
  {
    $children = array();

    foreach($tree_array as $index => $item)
    {
      if($item[$parent_hash] == $parent_id)
      {
        $children[] = $item;
        unset($tree_array[$index]);
      }
    }

    if(!($count = sizeof($children)))
      return;

    $children = lmbComplexArray :: sortArray($children, $sort_params);

    if(!$sorted_tree_array)
    {
      $sorted_tree_array = $children;
    }
    else
    {
      $ids = lmbComplexArray :: getColumnValues($id_hash, $sorted_tree_array);

      $offset = array_search($parent_id, $ids) + 1;

      array_splice($sorted_tree_array, $offset, 0, $children);
    }

    for($i=0; $i < $count; $i++)
    {
      lmbTreeRsProcessor :: _doSort($tree_array, $sorted_tree_array, $sort_params, $children[$i][$id_hash], $id_hash, $parent_hash);
    }
  }
}

?>