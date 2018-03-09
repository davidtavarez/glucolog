<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';
    protected $fillable = ['fecha', 'comida', 'medida', 'ayuno', 'comentario','user_id'];

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
