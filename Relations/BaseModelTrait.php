<?php  namespace Quallsbenson\RepositoryHelpers\Relations;


trait BaseTrait{


	public function getAllowedRelations()
	{

		return $this->allowedRelations;

	}


	public function createRelation( $type, $foreignKey, $localKey, $model = "Quallsbenson\RepositoryHelpers\BaseModel" )
	{

		if( !in_array( $type, $this->getAllowedRelations() ) )
			throw new \Exception( "Relation type: {$type} is not allowed " );

		return $this->{$type}( 
			$model,
			$foreignKey,
			$localKey,
			$model
		);

	}

}
