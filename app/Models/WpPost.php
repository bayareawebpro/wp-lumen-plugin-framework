<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Helpers\TimezoneHelper;

class WpPost extends Model {

	const POST_TYPE = 'post';

	/** Model Settings **/
	protected $table = 'posts';
	protected $primaryKey = 'ID';
	protected $guarded = ['ID'];
	protected $hidden = [];

	/** Timestamps **/
	const CREATED_AT = 'post_date_gmt';
	const UPDATED_AT = 'post_modified_gmt';
	protected $dates = ['post_date','post_modified'];

	/** Appendable Attributes **/
	public $appends = ['permalink'];

	/**
	 * Get Permalink by Traversal
	 * @return string
	 */
	public function getPermalinkAttribute(){

		$parent = $this;
		$segments = new Collection();

		do{
			$segments->push($parent->post_name);
		}while($parent = $parent->parent);

		return url($segments->reverse()->implode('/'));
	}

	/**
	 * Post Parent Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function parent(){
		return $this->hasOne(WpPost::class, 'ID','post_parent');
	}

	/**
	 * Post Author Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author(){
		return $this->belongsTo(WpUser::class, 'post_author','ID');
	}

	/**
	 * Post Children Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children(){
		return $this->hasMany(WpPost::class, 'post_parent','ID');
	}

	/**
	 * Convert Eloquent Model to WP_Post Object
	 * @return \WP_Post
	 */
	public function toWpPost(){
		$post = new \WP_Post((object) $this->getAttributes());
		return $post->get_instance($post->ID);
	}

	/**
	 * Get WpMeta Fields
	 * @param string $meta_key
	 * @param boolean $load_as_relations
	 * @return mixed
	 */
	public function getMeta($meta_key, $load_as_relations = false){
		$value = null;

		//Get Meta Data
		if($this->meta->where('meta_key',$meta_key)->count()){
			$value = $this->meta->where('meta_key',$meta_key)->first()->meta_value;
		}

		//Transform to Posts if Numeric Values (Advanced Custom Field Relations)
		if($load_as_relations && is_numeric($value) && $this->where('ID', $value)->exists()){

			return $this->where('ID', $value)->get();

		}elseif(is_array($value) && is_numeric($value[0])){

			return $this->whereIn('ID', $value)->get();
		}
		return $value;
	}

	/**
	 * Post Meta Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function meta(){
        return $this->hasMany(WpPostMeta::class, 'post_id','ID');
    }

	/**
	 * Taxonomy Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function taxonomy(){
		return $this->hasManyThrough(
			WpTermTaxonomy::class,
			WpTermRelationships::class,
			'object_id',
			'term_taxonomy_id',
			'ID',
			'term_taxonomy_id'
		);
	}

	/**
	 * Attach Taxonomy Relationship
	 * @return bool
	 */
	public function attachTaxonomy($taxonomy_id){

		$query = $this->taxonomy()->getParent();

		if(!$query->where('object_id', $this->ID)->where('term_taxonomy_id', $taxonomy_id)->exists()){
			return $query->insert(array(
				'object_id' => $this->ID,
				'term_taxonomy_id' => $taxonomy_id
			));
		}
		return false;
	}

	/**
	 * DeAttach Taxonomy Relationship
	 * @return bool
	 */
	public function detachTaxonomy($taxonomy_id){

		$query = $this->taxonomy()->getParent()->where('object_id', $this->ID)->where('term_taxonomy_id', $taxonomy_id);

		if($query->exists()){
			return $query->delete();
		}
		return false;
	}

	/**
	 * Get Post Content Formatted
	 * @param $value
	 * @return mixed
	 */
	public function getPostContentAttribute($value){
		return apply_filters('the_content', $value);
	}

	/**
	 * Get Post Date Attribute
	 * @param $value
	 * @return Carbon
	 */
	public function getPostDateAttribute($value){
		return Carbon::parse($value, TimezoneHelper::getOffset());
	}

	/**
	 * Get Post Modified Attribute
	 * @param $value
	 * @return Carbon
	 */
	public function getPostModifiedAttribute($value){
		return Carbon::parse($value, TimezoneHelper::getOffset());
	}

	/**
	 * Model Callbacks - Set additional WP_POST dates
	 */
	protected static function boot() {
		parent::boot();
		static::creating(function($model) {
			$model->post_type = self::POST_TYPE;
			$model->post_date = Carbon::now(TimezoneHelper::getOffset());
		});
		static::saving(function($model) {
			$model->post_modified = Carbon::now(TimezoneHelper::getOffset());
		});
	}

}