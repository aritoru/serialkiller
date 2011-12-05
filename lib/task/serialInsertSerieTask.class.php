<?php

class serialInsertSerieTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name','frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      new sfCommandOption('series', null, sfCommandOption::PARAMETER_REQUIRED, 'The series name')
      // add your own options here
    ));

    $this->namespace        = 'serial';
    $this->name             = 'insertSerie';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [serial:insertSerie|INFO] task does things.
Call it with:

  [php symfony serial:insertSerie|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $series = str_replace(' ','',$options['series']);
  }
}
