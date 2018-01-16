<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WpTermRelationships extends Model {

    protected $table = 'term_relationships';
    protected $primaryKey = 'object_id';
	public $timestamps = false;

}