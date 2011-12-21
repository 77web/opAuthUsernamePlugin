<?php

class opAuthUsernamePluginCleanTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace = 'opAuthUsernamePlugin';
    $this->name = 'clean';
    $this->briefDescription = 'cleanup member data';
    
    $this->addOptions(array(new sfCommandOption('days', null, sfCommandOption::PARAMETER_OPTIONAL, 'Days to expire', 14)));
    
    $this->detailedDescription = <<<EOF
Call it with:

 [./symfony opAuthUsernamePlugin:clean INFO]
EOF;
  }
  
  protected function execute($arguments = array(), $options = array())
  {
    $configuration = $this->createConfiguration('pc_frontend', 'cli');
    new sfDatabaseManager($this->configuration);
    
    $days = isset($options['days']) ? $options['days'] : 14;
    
    opActivateBehavior::disable();
    $date = date('Y-m-d H:i:s', time() - 60*60*24 * $days);
    Doctrine::getTable('Member')->createQuery('m')->delete()->addWhere('m.updated_at <= ?', $date)->addWhere('m.is_active = ?', false)->addWhere('m.name = ?', '')->execute();
    
  }
}