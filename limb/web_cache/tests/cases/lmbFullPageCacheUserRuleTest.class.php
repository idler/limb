<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbFullPageCacheUserRuleTest.class.php 5013 2007-02-08 15:38:13Z pachanga $
 * @package    web_cache
 */
lmb_require('limb/web_cache/src/lmbFullPageCacheRequest.class.php');
lmb_require('limb/web_cache/src/lmbFullPageCacheUser.class.php');
lmb_require('limb/web_cache/src/lmbFullPageCacheUserRule.class.php');
lmb_require('limb/net/src/lmbHttpRequest.class.php');

class lmbFullPageCacheUserRuleTest extends UnitTestCase
{
  function testMatch()
  {
    $rule = new lmbFullPageCacheUserRule($groups = array('test1', 'test2'));

    $lmbHttpRequest = new lmbHttpRequest('whatever', array(), array());
    $user = new lmbFullPageCacheUser($groups);
    $request = new lmbFullPageCacheRequest($lmbHttpRequest, $user);

    $this->assertTrue($rule->isSatisfiedBy($request));
  }

  function testNomatch()
  {
    $rule = new lmbFullPageCacheUserRule($groups = array('test1', 'test2'));

    $lmbHttpRequest = new lmbHttpRequest('whatever', array(), array());
    $user = new lmbFullPageCacheUser(array('test1'));
    $request = new lmbFullPageCacheRequest($lmbHttpRequest, $user);

    $this->assertFalse($rule->isSatisfiedBy($request));
  }

  function testNegativeMatch()
  {
    $rule = new lmbFullPageCacheUserRule(array('!test2'));

    $lmbHttpRequest = new lmbHttpRequest('whatever', array(), array());
    $user = new lmbFullPageCacheUser(array('test1'));
    $request = new lmbFullPageCacheRequest($lmbHttpRequest, $user);

    $this->assertTrue($rule->isSatisfiedBy($request));
  }

  function testNegativeNonmatch()
  {
    $rule = new lmbFullPageCacheUserRule(array('!test2'));

    $lmbHttpRequest = new lmbHttpRequest('whatever', array(), array());
    $user = new lmbFullPageCacheUser(array('test2'));
    $request = new lmbFullPageCacheRequest($lmbHttpRequest, $user);

    $this->assertFalse($rule->isSatisfiedBy($request));
  }

  function testMixedGroupsMatch()
  {
    $rule = new lmbFullPageCacheUserRule($groups = array('test1', '!test2'));

    $lmbHttpRequest = new lmbHttpRequest('whatever', array(), array());
    $user = new lmbFullPageCacheUser(array('test1'));
    $request = new lmbFullPageCacheRequest($lmbHttpRequest, $user);

    $this->assertTrue($rule->isSatisfiedBy($request));
  }
}

?>
