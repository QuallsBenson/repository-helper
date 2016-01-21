<?php namespace Quallsbenson\Illuminate\Database;

use \Illuminate\Database\Capsule\Manager;
use Quallsbenson\Repository\Database\DatabaseManagerInterface;

class DatabaseManager extends Manager implements DatabaseManagerInterface{

  protected $connection = null,
            $connectionParameters = array(),
            $queryManager;

  public function setConnectionParameters(array $param){

    $this->connectionParameters = array_merge($this->connectionParameters, $param);

  }

  public function __call($name, $param){

    if(is_object($this->manager) && method_exists($this->manager, $name))
      return call_user_func_array(array($this->getQueryManager(), $name), $param);

    throw new \Exception('Call to undefined method '.__CLASS__.'::'.$name);

  }

  public function connect(){

    if($this->isConnected()) return -1;

    $this->addConnection($this->connectionParameters);
    $this->bootEloquent();

    return $this->connection = 1;

  }

  public function isConnected(){

    return isset($this->connection);

  }

  public function getQueryManager(){

    $this->connect();
    return $this->getDatabaseManager();

  }

}
