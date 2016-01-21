<?php namespace Quallsbenson\Illuminate\Tests\Repository;

use Quallsbenson\Repository\Repository;

class UserRepository extends Repository{

  public function findById($id){

    return $this->getModel('User')->find($id);

  }
}
