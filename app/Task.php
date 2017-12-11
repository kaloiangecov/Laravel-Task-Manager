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
      'completed' => false,
      'to_do_list_id',
  ];

  function __construct()
  {

  }

  public function toDoList()
  {
    return $this->belongsTo('App\ToDoList');
  }
}
