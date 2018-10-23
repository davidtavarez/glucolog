<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function records()
    {
        return $this->hasMany('App\Models\Record');
    }

    public function weights()
    {
        return $this->hasMany('App\Models\Weight');
    }
}
