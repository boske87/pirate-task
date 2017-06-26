<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobProject extends Model
{
    protected $table = 'jobBoard';
    protected $fillable = [
        'title', 'email', 'description', 'slug','email_token'
    ];

    public function author()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
