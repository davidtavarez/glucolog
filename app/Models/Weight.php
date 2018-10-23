<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Weight extends Model
{
    use SoftDeletes;

    protected $table = 'weights';
    protected $fillable = ['weight', 'date', 'user_id'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function fcreated()
    {
        return $this->created_at->format('Y-m-d H:i:s A');
    }
}
