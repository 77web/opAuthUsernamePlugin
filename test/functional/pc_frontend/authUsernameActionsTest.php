<?php

include dirname(__FILE__).'/../../bootstrap/functional.php';

$browser = new opTestFunctional(new sfBrowser(), new lime_test(null, new lime_output_color()));

//include dirname(__FILE__).'/../../bootstrap/database.php';

$browser->setCulture('en');

//login
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
