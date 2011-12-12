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
    
    if(opConfig::get('op_auth_Username_pugin_require_mailaddress', 1)==1)
    {
      $this->form = new opAuthUsernamePluginRequestRegisterUriForm();
      if($request->isMethod(sfRequest::POST))
      {
        $this->form->bind($request->getParameter($this->form->getName()));
        if($this->form->isValid())
        {
          $this->form->sendMail();
          
          $this->getUser()->setFlash('notice', 'The register uri will be in your mailbox.');
          $this->redirect('@homepage');
        }
      }
      return sfView::INPUT;
    }
    
    $token = $member->generateRegisterToken();
    
    $this->getUser()->setMemberId($member->getId());
    $this->getUser()->setIsSNSRegisterBegin(true);

    $this->redirect('member/registerInput?token='.$token);
  }
}
