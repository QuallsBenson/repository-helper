<?php  namespace Quallsbenson\RepositoryHelpers;

use Quallsbenson\Repository\Repository;
use Quallsbenson\RepositoryHelpers\BaseModel as Model;

abstract class BaseRepository extends Repository{

	protected $modelName;


	public function all()
	{
		$model = $this->getBaseModel();

		$query = $model->query()->orderBy( $model->getOrderColumn(), 'DESC' );

		return $this->setConstraints( $query )->get();

	}


	public function find( $id )
	{

		$model = $this->getBaseModel();

		$query = $model->query()
		               ->where( $model->getPrimaryKey(), $id );

		return $this->setConstraints( $query )->get()->first();

	}

	public function prev( Model $model )
	{

		$query = $this->getBaseModel()
		    ->query()
			->where( $model->getOrderColumn(), "<", $model->getOrder() )
			->orderBy( $model->getOrderColumn(), 'DESC' )
			->take( 1 );

		return $this->setConstraints( $query )->get()->first();	

	}

	public function next( Model $model )
	{

		$query = $this->getBaseModel()
		    ->query()
			->where( $model->getOrderColumn(), ">", $model->getOrder() )
			->orderBy( $model->getOrderColumn(), 'ASC' )
			->take( 1 );

        return $this->setConstraints( $query )->get()->first();

	}

	public function getFirst()
	{

		$model = $this->getBaseModel();

		$query = $model
		    ->query()
		    ->orderBy( $model->getOrderColumn(), 'ASC' )
		    ->take( 1 );

		return $this->setConstraints( $query )->get()->first();

	}

	public function getLast()
	{

		$model = $this->getBaseModel();

		$query = $model
		     ->query()
		     ->orderBy( $model->getOrderColumn, 'DESC' )
		     ->take( 1 );

		return $this->setConstraints( $query )->get()->first();

	}

	public function getBaseModel()
	{

		return $this->getModel( $this->getModelName() );

	}

	public function getModelName()
	{

		if( !isset( $this->modelName ) )
		{
			$cls             = new \ReflectionClass( $this );
			$this->modelName = str_replace( 'Repository', '', $cls->getShortName() );
		}

		return $this->modelName;

	}

	protected function setConstraints( $query )
	{

		return $query;

	}

}
