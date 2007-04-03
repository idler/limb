<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbCmsDeleteNodeCommand.class.php 4989 2007-02-08 15:35:27Z pachanga $
 * @package    cms
 */
lmb_require('limb/web_app/src/command/lmbFormCommand.class.php');
lmb_require('limb/cms/src/model/lmbCmsNode.class.php');

class lmbCmsDeleteNodeCommand extends lmbFormCommand
{
  function __construct()
  {
    parent :: __construct('', 'delete_form');
  }

  function _onValid()
  {
    if($this->request->get('delete'))
    {
      foreach($this->request->getArray('ids') as $id)
      {
        $node = lmbActiveRecord :: findById('lmbCmsNode', (int)$id);
        $node->destroy();
      }
      $this->closePopup();
    }
  }
}

?>
