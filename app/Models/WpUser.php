<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class WpUser extends Model implements AuthenticatableContract, AuthorizableContract
{
	use Authenticatable, Authorizable;

    protected $table = 'users';
    protected $primaryKey = 'ID';
	protected $guarded = ['ID'];

    protected $fillable = [
    	'display_name',
    	'user_login',
	    'user_email',
	    'user_pass',
	    'user_registered'
    ];

	public $timestamps = false;
	public $dates = ['user_registered'];

    public function meta(){
        return $this->hasMany(WpUserMeta::class, 'ID','user_id');
    }

	public function setUserPassAttribute($value){
		$this->attributes['user_pass'] = wp_hash_password($value);
	}

	public function wpLogin(){
		clean_user_cache($this->ID);
		wp_clear_auth_cookie();
		wp_set_current_user($this->ID);
		wp_set_auth_cookie($this->ID, true, false);
	}

	protected static function boot() {
		parent::boot();

		static::creating(function($model) {
			$model->user_login = str_slug($model->user_email);
			$model->user_nicename = str_slug($model->user_email);
			$model->user_registered = Carbon::now()->toDateTimeString();
        });
		static::created(function($model) {
			wp_update_user(array(
				'ID'=> $model->ID,
				'role'=>'subscriber'
			));
        });

		static::saving(function($model) {

		});
    }
}