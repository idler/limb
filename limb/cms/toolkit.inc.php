<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: toolkit.inc.php 4989 2007-02-08 15:35:27Z pachanga $
 * @package    cms
 */
lmb_require('limb/toolkit/src/lmbToolkit.class.php');
lmb_require('limb/cms/src/toolkit/lmbCmsTools.class.php');
lmbToolkit :: merge(new lmbCmsTools());

?>