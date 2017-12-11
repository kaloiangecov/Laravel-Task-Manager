<?php namespace App;

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'name',
       'display_name',
       'description',
   ];

   function __construct()
   {

   }

   public function permissions()
   {
     return $this->belongsToMany('App\Permission');
   }

   public function users()
   {
     return $this->belongsToMany('App\User');
   }
}
