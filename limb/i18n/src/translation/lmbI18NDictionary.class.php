<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbI18NDictionary.class.php 4998 2007-02-08 15:36:32Z pachanga $
 * @package    i18n
 */

class lmbI18NDictionary
{
  protected $translations;

  function __construct($translations = array())
  {
    $this->translations = $translations;
  }

  function isEmpty()
  {
    return sizeof($this->translations) == 0;
  }

  function translate($text, $attributes = array())
  {
    if(isset($this->translations[$text]) &&
       !empty($this->translations[$text]))
      $translation = $this->translations[$text];
    else
      $translation = $text;

    if($attributes)
      return str_replace(array_keys($attributes), array_values($attributes), $translation);
    else
      return $translation;
  }

  function add($text, $translation = '')
  {
    $this->translations[$text] = $translation;
  }

  function has($text)
  {
    return isset($this->translations[$text]);
  }

  function isTranslated($text)
  {
    return isset($this->translations[$text]) &&
           !empty($this->translations[$text]);
  }

  function setTranslations($translations)
  {
    $this->translations = $translations;
  }

  function getTranslations()
  {
    return $this->translations;
  }

  function merge($d)
  {
    $dictionary = new lmbI18NDictionary($this->getTranslations());

    $translations = $d->getTranslations();
    foreach($translations as $text => $translation)
      $dictionary->add($text, $translation);

    return $dictionary;
  }

  function hasSameEntries($d)
  {
    foreach($this->translations as $text => $translation)
    {
      if(!$d->has($text))
        return false;
    }
    return true;
  }

  function isEqual($d)
  {
    return $this->translations == $d->getTranslations();
  }
}

?>
