<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peso extends Model
{
    protected $table = 'pesos';
    protected $fillable = ['peso', 'fecha', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function fcreated()
    {
        return $this->created_at->format('Y-m-d H:i:s A');
    }
}
