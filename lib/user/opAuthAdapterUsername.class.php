<?php

class opAuthAdapterUsername extends opAuthAdapter
{
  protected
    $authModuleName = 'authUsername';
  
  public function isRegisterBegin($memberId = null)
  {
    opActivateBehavior::disable();
    $member = Doctrine::getTable('Member')->find((int)$memberId);
    opActivateBehavior::enable();

    if (!$member)
    {
      return false;
    }
    
    if (!$member->getIsActive())
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function isRegisterFinish($memberId = null)
  {
    opActivateBehavior::disable();
    $member = Doctrine::getTable('Member')->find((int)$memberId);
    opActivateBehavior::enable();

    if (!$member || !$member->getName())
    {
      return false;
    }

    if ($member->getIsActive())
    {
      return false;
    }
    else
    {
      return true;
    }
  }
}