<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WpTermMeta extends Model {

    protected $table = 'termmeta';
    protected $primaryKey = 'meta_id';
	public $timestamps = false;

    public function term(){
        return $this->belongsTo(WpTermTaxonomy::class, 'meta_id','term_taxonomy_id');
    }

}