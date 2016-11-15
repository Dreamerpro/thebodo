<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use \App\Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','authprovider_id','authprovider','created_at','updated_at','deleted_at'
    ];
    public $incrementing=false;

    public function roles()
    {
        return $this->belongsToMany('\App\Models\Admin\Role','role_user','user_id','role_id');
    }
    public function hasRole($name)
    {
        return \Auth::user()->roles()->where('name',$name)->first() || false;
    }
    public function words()
    {
        return $this->hasMany('App\Models\Dictionary\Dictionary','user_id','id');
    }
    public function canEditWord($word)
    {
        return $word->user_id==$this->id;
    }
}
