<?php  namespace Quallsbenson\RepositoryHelpers\Relations;


trait UploadRelationTrait{


	public function getUploads()
	{

		return $this->uploads;

	}


	public function hasUpload( $type )
	{

		return isset( $this->uploads[ $type ] ) || in_array( $type, $this->uploads );

	}

	public function getUpload( $name )
	{

		$uploads = $this->getUploads();

		if( isset( $uploads[ $name ] ) )
			return $uploads['name'];

		foreach( $uploads as $k => $v )
		{

			if( is_string( $v ) && $v === $name )
				return $uploads[$k];

		}

		return null;

	}


	public function getUploadRelation( $name )
	{

		$upload = $this->getUpload( $name );
		$type   = 'hasMany';
		$fKey   = 'recordNum';
		$lKey   = 'num';
		$model  = 'Quallsbenson\RepositoryHelpers\UploadModel';

		if( is_array( $upload ) )
		{

			$type  = @$upload['type']  ?: $type;
			$model = @$upload['model'] ?: $model;
			
		}

		return $this->createRelation( 
			$type,  
			$fKey,
			$lKey,
			$model
		)
		->where( "tableName", $this->getTableName() )
		->where( "fieldName", $name );

	}

}
