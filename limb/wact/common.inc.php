<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package wact
 * @version $Id: common.inc.php 5969 2007-06-08 10:51:09Z pachanga $
 */
require_once(dirname(__FILE__) . '/error.inc.php');

if(!defined('WACT_DEFAULT_CONFIG_DIR'))
  define('WACT_DEFAULT_CONFIG_DIR', 'limb/wact/config/');

if(!defined('WACT_CACHE_DIR'))
  define('WACT_CACHE_DIR', dirname(__FILE__) . '/cache/');

set_magic_quotes_runtime(0);
?>