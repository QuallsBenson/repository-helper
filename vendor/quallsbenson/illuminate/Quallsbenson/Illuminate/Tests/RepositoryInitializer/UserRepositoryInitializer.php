<?php namespace Quallsbenson\Illuminate\Tests\RepositoryInitializer;

use Quallsbenson\Repository\RepositoryInitializer;
use Quallsbenson\Illuminate\Tests\Repository\UserRepository;

class UserRepositoryInitializer extends RepositoryInitializer{

  public function initialize($repository, array $services = array()){

    if( ($repository instanceof UserRepository) === false)
      throw new \Exception('Repository must be User Repository');

    parent::initialize($repository, $services);  


  }

}
