<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbMaterializedPathTreeTest.class.php 5677 2007-04-18 14:02:43Z alex433 $
 * @package    tree
 */
lmb_require('limb/tree/src/lmbMPTree.class.php');
lmb_require(dirname(__FILE__) . '/lmbTreeTestBase.class.php');


class lmbMPTreeTest extends lmbTreeTestBase
{
  protected $node_table = 'test_materialized_path_tree';

  function _createTreeImp()
  {
    return new lmbMPTree($this->node_table, $this->conn,
                         array('id' => 'id', 'parent_id' => 'p_parent_id',
                               'level' => 'p_level', 'identifier' => 'p_identifier',
                               'path' => 'p_path'));
  }

  function _cleanUp()
  {
    $this->db->delete($this->node_table);
  }

  function _checkProperNesting($nodes, $line='')
  {
    $this->assertEqual(lmbArrayHelper :: sortArray($nodes, array('path' => 'ASC')),
                       $nodes);

    $path = lmbArrayHelper :: getMinColumnValue('path', $nodes, $index);
    $parent_paths[] = $this->_getParentPath($path);

    $counter = 0;
    foreach($nodes as $id => $node)
    {
      $parent_path = $this->_getParentPath($node['path']);

      $this->assertTrue(in_array($parent_path, $parent_paths),
        'path is improperly nested: ' . $node['path'] . ' , expected parent not found: ' . $parent_path . ' at line: ' . $line);

      $parent_paths[] = $node['path'];
    }
  }

  function _getParentPath($path)
  {
    preg_match('~^(.*/)[^/]+/$~', $path, $matches);
    return $matches[1];
  }
}
?>