<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WpPostMeta extends Model {
    protected $table = 'postmeta';
    public $timestamps = false;
    public $fillable = ['meta_key', 'meta_value'];

    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            //$post->created_by = Auth::user()->id;
            //$post->updated_by = Auth::user()->id;
        });

        static::updating(function($post){
            // $post->updated_by = Auth::user()->id;
        });
    }
    public function post(){
        $this->belongsTo(WpPost::class,'ID', 'post_id');
    }

	public function getMetaValueAttribute($value){
		$value = maybe_unserialize($value);

		if(is_array($value) && sizeof($value) == 1){
			$value = $value[0];
		}
		if(is_numeric($value)){
			$value = intval($value);
		}

		return $value;
	}
}
