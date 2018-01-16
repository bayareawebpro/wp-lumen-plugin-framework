<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WpUserMeta extends Model {

    protected $table = 'usermeta';
	public $timestamps = false;

    public function meta(){
        return $this->hasOne(WpUser::class, 'user_id','ID');
    }
}