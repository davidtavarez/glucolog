<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weight extends Model
{
    use SoftDeletes;

    protected $table = 'weights';
    protected $fillable = ['weight', 'date', 'user_id', 'board_id'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function board()
    {
        return $this->belongsTo('App\Models\Board');
    }
    
    public function fcreated()
    {
        return $this->created_at->format('Y-m-d H:i:s A');
    }
}
