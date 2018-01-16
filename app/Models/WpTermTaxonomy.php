<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WpTermTaxonomy extends Model {

    protected $table = 'term_taxonomy';
    protected $primaryKey = 'term_taxonomy_id';
	public $timestamps = false;

	public function term(){

		return $this->hasOne(
			WpTerm::class,
			'term_id', // Local key on this table...
			'term_id' // Local key on WpTermRelationships table...
		);

	}
}