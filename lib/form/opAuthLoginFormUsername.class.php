<?php
/**
 * opAuthLoginFormUsername represents a form to login by username.
 *
 * @package    opAuthLoginFormUsername
 * @subpackage form
 * @author     Hiromi Hishida <info@77-web.com>
 */
class opAuthLoginFormUsername extends opAuthLoginForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormInput(),
      'password' => new sfWidgetFormInputPassword(),
    ));

    $this->setValidatorSchema(new sfValidatorSchema(array(
      'username' => new sfValidatorString(),
      'password' => new sfValidatorString(),
    )));

    $this->mergePostValidator(
      new opAuthValidatorMemberConfigAndPassword(array('config_name' => 'username', 'field_name' => 'username'))
    );
    
    parent::configure();
  }
}