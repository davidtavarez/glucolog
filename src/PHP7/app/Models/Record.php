<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Record extends Model
{
    use SoftDeletes;

    protected $table = 'records';
    protected $fillable = ['date', 'measure', 'status', 'comment','user_id','condition', 'board_id'];
    protected $dates = ['deleted_at'];

    public function path()
    {
        return '/records/' . $this->id;
    }

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
