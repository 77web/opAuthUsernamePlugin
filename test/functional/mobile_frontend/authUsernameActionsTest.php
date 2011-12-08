<?php

include dirname(__FILE__).'/../../bootstrap/functional.php';

$browser = new opTestFunctional(new sfBrowser(), new lime_test(null, new lime_output_color()));
$browser->setMobile();

//include dirname(__FILE__).'/../../bootstrap/database.php';

$browser->setCulture('en');

//login

//first, disable opAuthMailAddressPlugin & opAuthMobileUIDPlugin
$plugin1 = Doctrine::getTable('Plugin')->findOneByName('opAuthMailAddressPlugin');
if(!$plugin1)
{
  $plugin1 = new Plugin();
  $plugin1->setName('opAuthMailAddressPlugin');
}
$plugin1->setIsEnabled(false);
$plugin1->save();
$plugin2 = Doctrine::getTable('Plugin')->findOneByName('opAuthMobileUIDPlugin');
if(!$plugin2)
{
  $plugin2 = new Plugin();
  $plugin2->setName('opAuthMobileUIDPlugin');
}
$plugin2->setIsEnabled(false);
$plugin2->save();

$browser->get('/')
  ->setField('authUsername[username]', 'testuser')
  ->setField('authUsername[password]', 'password')
  ->click('Login')
  ->with('request')->begin()
    ->isParameter('module', 'member')
    ->isParameter('action', 'login')
    ->isParameter('authMode', 'Username')
  ->end()
  ->with('response')->begin()
    ->isStatusCode(302)
  ->end()
  ->with('user')->begin()
    ->isAuthenticated()
  ->end()
;
//enable opAuthMailAddressPlugin, opAuthMobileUIDPlugin
$plugin1->setIsEnabled(true);
$plugin1->save();

$plugin2->setIsEnabled(true);
$plugin2->save();


//register
$browser->get('/authUsername/register')
  ->with('request')->begin()
    ->isParameter('module', 'authUsername')
    ->isParameter('action', 'register')
  ->end()
  ->with('response')->begin()
    ->isStatusCode(302)
  ->end()
  ->followRedirect()
  ->with('request')->begin()
    ->isParameter('module', 'member')
    ->isParameter('action', 'registerInput')
  ->end()
  ->with('response')->begin()
    ->isStatusCode(200)
  ->end()
;
