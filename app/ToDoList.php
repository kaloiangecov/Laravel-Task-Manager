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

  public function tasks() {
    return $this->hasMany('App\Task');
  }

  public function tasksCount() {
    return $this->hasOne('App\Task')->selectRaw('to_do_list_id, count(*) as count')->groupBy('to_do_list_id');
  }

  public function user() {
    return $this->belongsTo('App\User');
  }
}
