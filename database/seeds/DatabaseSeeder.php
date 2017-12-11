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
        DB::table('permissions')->delete();
        DB::table('roles')->delete();
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();
        DB::table('tasks')->delete();
        DB::table('to_do_lists')->delete();


        $permissions = array(
          ['id' => 1, 'name' => 'create_task'],
          ['id' => 2, 'name' => 'read_task'],
          ['id' => 3, 'name' => 'update_task'],
          ['id' => 4, 'name' => 'delete_tasks'],
          ['id' => 5, 'name' => 'create_todolist'],
          ['id' => 6, 'name' => 'read_todolist'],
          ['id' => 7, 'name' => 'update_todolist'],
          ['id' => 8, 'name' => 'delete_todolist'],
          ['id' => 9, 'name' => 'create_user'],
          ['id' => 10, 'name' => 'read_user'],
          ['id' => 11, 'name' => 'update_user'],
          ['id' => 12, 'name' => 'delete_user'],
        );

        DB::table('permissions')->insert($permissions);

        // foreach ($permissions as $permission)
        // {
        //     Permission::create($permission)
        // }


        $roles = array(
          ['id' => 1, 'name' => 'admin'],
          ['id' => 2, 'name' => 'user'],
        );

        DB::table('roles')->insert($roles);

        $permission_role = array(
          ['permission_id' => 1, 'role_id' => 1],  ['permission_id' => 2, 'role_id' => 1],
          ['permission_id' => 3, 'role_id' => 1],  ['permission_id' => 4, 'role_id' => 1],
          ['permission_id' => 5, 'role_id' => 1],  ['permission_id' => 6, 'role_id' => 1],
          ['permission_id' => 7, 'role_id' => 1],  ['permission_id' => 8, 'role_id' => 1],
          ['permission_id' => 9, 'role_id' => 1],  ['permission_id' => 10, 'role_id' => 1],
          ['permission_id' => 11, 'role_id' => 1], ['permission_id' => 12, 'role_id' => 1],

          ['permission_id' => 1, 'role_id' => 2],  ['permission_id' => 2, 'role_id' => 2],
          ['permission_id' => 3, 'role_id' => 2],  ['permission_id' => 4, 'role_id' => 2],
          ['permission_id' => 5, 'role_id' => 2],  ['permission_id' => 6, 'role_id' => 2],
          ['permission_id' => 7, 'role_id' => 2],  ['permission_id' => 8, 'role_id' => 2],
          ['permission_id' => 9, 'role_id' => 2],  ['permission_id' => 10, 'role_id' => 2],
          ['permission_id' => 11, 'role_id' => 2], ['permission_id' => 12, 'role_id' => 2],
        );

        DB::table('permission_role')->insert($permission_role);

        //TODO: replace regular password with hashed one
        // Hash::make('password');
        $users = array(
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@gmail.com', 'password' => 'admin', 'suspended' => false, 'profile_image' => 'none'],
            ['id' => 2, 'username' => 'pe6o', 'email' => 'petur@gmail.com', 'password' => 'password', 'suspended' => false, 'profile_image' => 'none'],
        );

        DB::table('users')->insert($users);


        $role_user = array(
          ['user_id' => 1, 'role_id' => 1],
          ['user_id' => 2, 'role_id' => 2],
        );

        DB::table('role_user')->insert($role_user);


        Model::reguard();
    }
}
