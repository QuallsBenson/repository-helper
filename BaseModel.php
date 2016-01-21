<?php  namespace Quallsbenson\RepositoryHelpers;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel{


	use \Timeequities\Sites\GEBundle\Model\Relations\BaseTrait;
	use \Timeequities\Sites\GEBundle\Model\Relations\UploadRelationTrait;


	protected $uploads          = [ 'featured_image', 'thumbnail', 'profile_pic', 'photo', 'photos' ],
	          $orderColumn      = 'dragSortOrder', 
	          $allowedRelations = [ 'hasOne', 'hasMany' ],
	          $primaryKey       = "num";


	public function __call( $fn, $args )
	{

		if( $this->hasUpload( $fn ) )
		{
			return $this->getUploadRelation( $fn ); 
		}

	}

	public function getTableName()
	{
		
		$i = 1;
		return str_replace('cms_', '', $this->table, $i);

	}

	public function getOrderColumn()
	{

		return $this->orderColumn;

	}

	public function getPrimaryKey()
	{

		return $this->primaryKey;

	}
	

	public function getOrder()
	{

		return $this->{ $this->getOrderColumn() };

	}

}
