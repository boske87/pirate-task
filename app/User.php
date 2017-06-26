<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
            return $this
                ->belongsToMany('App\Role')
                ->withTimestamps();
    }

    // user has many jobs
    public function jobProjects()
    {
        return $this->hasMany('App\JobProject','user_id');
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function checkIfFirstPosting($email) {
        return $this->jobProjects()
            ->where('email', $email)
            ->count() == 0 ? true : false;
    }

    public static function getJobBoardModerators() {
        return self::whereHas(
            'roles', function($q){
            $q->where('name', 'moderator');
        })->get();
    }
}
