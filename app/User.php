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
         'username',
         'email',
         'role_id',
         'password',
         'suspended',
         'profile_image',
         'last_login',
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
      return $this->hasOne('App\Role');
    }

    public function toDoLists() {
      return $this->hasMany('App\ToDoList');
    }

    public function listsCount() {
      return $this->hasOne('App\ToDoList')->selectRaw('user_id, count(*) as count')->groupBy('user_id');
    }

    public function emails() {
      return $this->belongsToMany('App\Email')
        ->withPivot('seen');
    }
}
