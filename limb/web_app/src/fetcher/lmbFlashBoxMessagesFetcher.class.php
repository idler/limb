<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbFlashBoxMessagesFetcher.class.php 5431 2007-03-29 15:33:42Z serega $
 * @package    web_app
 */
lmb_require('limb/datasource/src/lmbArrayDataset.class.php');
lmb_require('limb/web_app/src/fetcher/lmbFetcher.class.php');

class lmbFlashBoxMessagesFetcher extends lmbFetcher
{
  protected function _createDataSet()
  {
    $result = array();

    $flash_box = lmbToolkit :: instance()->getFlashBox();
    foreach($flash_box->getMessages() as $message)
      $result[] = array('text' => $message);

    $flash_box->resetMessages();

    return new lmbArrayDataset($result);
  }
}
?>
