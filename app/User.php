<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_user', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function records()
    {
        return $this->hasMany('App\Record');
    }

    public function weights()
    {
        return $this->hasMany('App\Weight');
    }

    public function path()
    {
        return '/admin/' . $this->id . '/edit';
    }

    public function isAdmin(){
        return (\Auth::check() && $this->is_admin === 1);
    }
}
