<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Record extends Model
{
    use SoftDeletes;

    protected $table = 'records';
    protected $fillable = ['date', 'food', 'measure', 'is_in_fast', 'comment','user_id','food_type'];
    protected $dates = ['deleted_at'];

    public function path()
    {
        return '/records/' . $this->id;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function fcreated()
    {
        return $this->created_at->format('Y-m-d H:i:s A');
    }
}
