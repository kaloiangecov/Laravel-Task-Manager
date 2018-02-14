<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index() {
        return response()->json(['users'=>User::all()]);
    }

    public function getAllWithListsCount() {
        $users = User::with('listsCount')->get();
        return response()->json(['users'=>$users]);
    }

    public function findUsersByStatus($suspendedStatus = null) {
        if($suspendedStatus != null) {
            return response()->json(['users'=>User::where('suspended', $suspendedStatus)->get()]);
        }

        return response()->json(['users'=>User::all()]);
    }

    public function countUsers() {
        return response()->json(['usersCount'=>User::count()]);
    }

    public function findByEmail($query) {
        return response()->json(['users'=>User::where('email', 'like', "%$query%")->get()]);
    }


    public function store(Request $request) {
        return response()->json(['users'=>User::create($request->all())]);
    }


    public function show(User $user) {
        return response()->json(['users'=>$user]);
    }


    public function edit(User $user) {
        return response()->json(['users'=>$user]);
    }


    public function update(Request $request, User $user) {
        $user->update($request->all());
        return response()->json(['users'=>$user]);
    }


    public function destroy($user_id) {
        $user = User::find($user_id);
        $user->delete();
        return response()->json(['users'=>$user]);
    }
}
