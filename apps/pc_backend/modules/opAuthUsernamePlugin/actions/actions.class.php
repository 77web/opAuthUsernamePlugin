<?php

/**
 * opAuthUsernamePlugin actions.
 *
 * @package    opAuthUsernamePlugin
 * @subpackage pc_backend
 * @author     Hiromi Hishida<info@77-web.com>
 */
class opAuthUsernamePluginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('opAuthUsernamePlugin', 'setting');
  }
  
  public function executeSetting(sfWebRequest $request)
  {
    $adapter = new opAuthAdapterUsername('Username');
    $this->form = $adapter->getAuthConfigForm();
    if ($request->isMethod(sfWebRequest::POST))
    {
      $this->form->bind($request->getParameter('auth'.$adapter->getAuthModeName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        
        $this->getUser()->setFlash('notice', 'Setting of opAuthUsernamePlugin was successfully updated.');
        $this->redirect('opAuthUsernamePlugin/setting');
      }
    }
  }
}
