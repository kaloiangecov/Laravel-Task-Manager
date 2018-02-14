<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        DB::table('users')->delete();
        DB::table('tasks')->delete();
        DB::table('to_do_lists')->delete();
        DB::table('emails')->delete();
        DB::table('email_user')->delete();
        DB::table('roles')->delete();

        $roles = array(
          ['id' => 1, 'name' => 'admin'],
          ['id' => 2, 'name' => 'user'],
        );

        DB::table('roles')->insert($roles);

        //TODO: replace regular password with hashed one
        // Hash::make('password');
        $users = array(
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@gmail.com',
             'password' => 'admin', 'suspended' => false, 'profile_image' => 'none',
             'role_id' => 1, 'created_at' => '2018-02-12 16:49:37'],

            ['id' => 2, 'username' => 'pe6o', 'email' => 'petur@gmail.com',
             'password' => 'password', 'suspended' => false, 'profile_image' => 'none',
             'role_id' => 2, 'created_at' => '2018-02-12 16:49:37'],

            ['id' => 3, 'username' => 'ivan', 'email' => 'ivan@gmail.com',
             'password' => 'password', 'suspended' => true, 'profile_image' => 'none',
             'role_id' => 2, 'created_at' => '2018-02-12 16:49:37'],

        );

        DB::table('users')->insert($users);


        $lists = array(
            ['id' => 1, 'user_id' => 1, 'name' => 'admin responsibilities', 'created_at' => '2018-02-12 16:49:37'],
            ['id' => 2, 'user_id' => 1, 'name' => 'personal stuff', 'created_at' => '2018-02-12 16:49:37'],
            ['id' => 3, 'user_id' => 2, 'name' => 'watch list', 'created_at' => '2018-02-12 16:49:37'],
            ['id' => 4, 'user_id' => 3, 'name' => 'shopping list', 'created_at' => '2018-02-12 16:49:37'],
        );

        DB::table('to_do_lists')->insert($lists);


        $tasks = array(
          ['id' => 1, 'to_do_list_id' => 1, 'name' => 'suspend invan', 'completed' => 1],
          ['id' => 2, 'to_do_list_id' => 1, 'name' => 'look for iregulations', 'completed' => 0],
          ['id' => 3, 'to_do_list_id' => 2, 'name' => 'dentist apointment', 'completed' => 0],
          ['id' => 4, 'to_do_list_id' => 2, 'name' => 'get car checked', 'completed' => 0],
          ['id' => 5, 'to_do_list_id' => 2, 'name' => 'email spas', 'completed' => 1],
          ['id' => 6, 'to_do_list_id' => 3, 'name' => 'watch age of ultron', 'completed' => 1],
          ['id' => 7, 'to_do_list_id' => 3, 'name' => 'watch jumanji 2', 'completed' => 0],
          ['id' => 8, 'to_do_list_id' => 4, 'name' => 'potatoes', 'completed' => 0],
          ['id' => 9, 'to_do_list_id' => 4, 'name' => 'tomatoes', 'completed' => 0],
          ['id' => 10, 'to_do_list_id' => 4, 'name' => 'bread', 'completed' => 0],
          ['id' => 11, 'to_do_list_id' => 4, 'name' => 'cheese', 'completed' => 0],
          ['id' => 12, 'to_do_list_id' => 4, 'name' => 'olive oil', 'completed' => 0],
        );

        DB::table('tasks')->insert($tasks);


        $emails = array(
            ['id' => 1, 'author' => 'admin', 'subject' => 'new year',
             'content' => 'happy 2018 to every one', 'status' => 'sent',
             'scheduled' => 3, 'people_sent' => 3, 'user_id' => 1],

        );

        DB::table('emails')->insert($emails);


        $email_user = array(
          ['user_id' => 1, 'email_id' => 1, 'seen' => 0],
          ['user_id' => 2, 'email_id' => 1, 'seen' => 0],
          ['user_id' => 3, 'email_id' => 1, 'seen' => 0],
        );

        DB::table('email_user')->insert($email_user);

        Model::reguard();
    }
}
