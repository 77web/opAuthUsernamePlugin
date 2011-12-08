<?php

/**
 * member register form for opAuthUsernamePlugin
 * @package    opAuthUsernamePlugin
 * @subpackage form
 * @auther     Hiromi Hishida<info@77-web.com>
 */
class opAuthRegisterFormUsername extends opAuthRegisterForm
{
  public function configure()
  {
    parent::configure();
    
    $this->setWidget('username', new sfWidgetFormInputText());
    $this->setValidator('username', new sfValidatorString());
    
    $this->mergePostValidator(new sfValidatorCallback(array('callback'=>array($this, 'validateUniqueUsername'))));
  }
  
  public function validateUniqueUsername($validator, $values, $arguments = array())
  {
    if(isset($values['username']))
    {
      $config = Doctrine::getTable('MemberConfig')->retrieveByNameAndValue('username', $values['username']);
      if($config)
      {
        throw new sfValidatorError($validator, 'The username is already used.');
      }
    }
    
    return $values;
  }
}