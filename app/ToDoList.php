<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'user_id',
  ];

  function __construct()
  {

  }

  public function tasks()
  {
    return $this->hasMany('App\Task');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
