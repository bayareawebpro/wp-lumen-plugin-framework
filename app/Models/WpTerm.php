<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WpTerm extends Model {

    protected $table = 'terms';
    protected $primaryKey = 'term_id';
	public $timestamps = false;

    public function meta(){
        $this->hasMany(WpTermMeta::class, 'term_id','term_id');
    }
	public function taxonomy(){

		return $this->belongsTo(
			WpTermTaxonomy::class,
			'term_id', // Local key on this table...
			'term_id' // Local key on WpTermRelationships table...
		);

	}
	public function posts(){
		return $this->hasManyThrough(
			WpPost::class,
			WpTermRelationships::class,
			'term_taxonomy_id', // Foreign key on WpTermRelationships table...
			'ID', // Foreign key on Post table...
			'term_id', // Local key on this table...
			'object_id' // Local key on WpTermRelationships table...
		);
	}
}