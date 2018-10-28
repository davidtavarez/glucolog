<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_user', 'is_admin', 'board_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function board()
    {
        return $this->belongsTo('App\Models\Board');
    }

    public function records()
    {
        return $this->hasMany('App\Models\Record');
    }

    public function weights()
    {
        return $this->hasMany('App\Models\Weight');
    }

    public function path()
    {
        return '/admin/' . $this->id . '/edit';
    }
}
