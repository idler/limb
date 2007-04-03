<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbAtleastOneFieldRequiredRuleTest.class.php 5413 2007-03-29 10:08:00Z pachanga $
 * @package    validation
 */
require_once(dirname(__FILE__) . '/lmbValidationRuleTestCase.class.php');
lmb_require('limb/validation/src/rule/lmbAtleastOneFieldRequiredRule.class.php');

class lmbAtleastOneFieldRequiredRuleTest extends lmbValidationRuleTestCase
{
  function testValidSinceFieldIsPresent()
  {
    $dataspace = new lmbDataspace(array('field1' => 'whatever'));

    $rule = new lmbAtleastOneFieldRequiredRule('field1', 'field2');

    $this->error_list->expectNever('addError');

    $rule->validate($dataspace, $this->error_list);
  }

  function testInvalidSinceFieldIsNotPresent()
  {
    $dataspace = new lmbDataspace();

    $rule = new lmbAtleastOneFieldRequiredRule('field1', 'field2');

    $this->error_list->expectOnce('addError',
                                  array(lmb_i18n('Atleast one field required among: {fields}', array('{fields}' => '{0}, {1}'), 'validation'),
                                        array('field1', 'field2'),
                                        array()));

    $rule->validate($dataspace, $this->error_list);
  }

  function testValidAndMoreFields()
  {
    $dataspace = new lmbDataspace(array('field3' => 'whatever'));

    $rule = new lmbAtleastOneFieldRequiredRule('field1', 'field2', 'field3');

    $this->error_list->expectNever('addError');

    $rule->validate($dataspace, $this->error_list);
  }

  function testInvalidAndMoreFields()
  {
    $dataspace = new lmbDataspace();

    $rule = new lmbAtleastOneFieldRequiredRule('field1', 'field2', 'field3');

    $this->error_list->expectOnce('addError',
                                  array(lmb_i18n('Atleast one field required among: {fields}', array('{fields}' => '{0}, {1}, {2}'), 'validation'),
                                        array('field1', 'field2', 'field3'),
                                        array()));

    $rule->validate($dataspace, $this->error_list);
  }
}

?>