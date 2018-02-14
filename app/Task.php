<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'completed',
      'to_do_list_id',
  ];

  public function toDoList() {
    return $this->belongsTo('App\ToDoList');
  }
}
