<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'author',
       'subject',
       'content',
       'emails_count',
       'emails_sent',
   ];


   public function users()
   {
     return $this->belongsToMany('App\User');
   }
}
