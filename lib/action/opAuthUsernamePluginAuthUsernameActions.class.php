<?php
/**
 * @package    opAuthUsernamePlugin
 * @subpackage action
 * @auther     Hiromi Hishida<info@77-web.com>
 */
class opAuthUsernamePluginAuthUsernameActions extends opAuthAction
{
  public function executeRegister(sfWebRequest $request)
  {
    $this->getUser()->setCurrentAuthMode('Username');

    $member = Doctrine::getTable('Member')->createPre();
    $token = $member->generateRegisterToken();
    
    $this->getUser()->setMemberId($member->getId());
    $this->getUser()->setIsSNSRegisterBegin(true);

    $this->redirect('member/registerInput?token='.$token);
  }
}
