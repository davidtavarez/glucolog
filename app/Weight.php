<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'weights';
    protected $fillable = ['weight', 'date', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function fcreated()
    {
        return $this->created_at->format('Y-m-d H:i:s A');
    }
}
