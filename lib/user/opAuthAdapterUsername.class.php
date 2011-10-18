<?php

class opAuthAdapterUsername extends opAuthAdapter
{
  protected
    $authModuleName = 'Username';
  
  public function isRegisterBegin($memberId = null)
  {
    return false;
  }
  
  public function isRegisterFinish($memberId = null)
  {
    return false;
  }
}