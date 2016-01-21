<?php

use Quallsbenson\Repository\RepositoryManager;
use Quallsbenson\Illuminate\Database\DatabaseManager;


require dirname(dirname(__FILE__)) .'/vendor/autoload.php';

class IlluminateTest extends PHPUnit_Framework_TestCase{

  public function testInitializeManager(){

    $manager = new RepositoryManager('Quallsbenson\Illuminate\Tests\Repository',
                                     'Quallsbenson\Illuminate\Tests\Entity',
                                     'Quallsbenson\Illuminate\Tests\RepositoryInitializer');

    $db      = new DatabaseManager;
    $db->setConnectionParameters(require('config.php'));

    $manager->setDatabaseManager($db);

    return $manager;

  }

  /**
  * @depends testInitializeManager
  **/

  public function testModel($manager){

    $userRepo = $manager->get('User');
    $user     = $userRepo->findById(1);

    $this->assertNotEmpty($user);


  }


}
