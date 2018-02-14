<?php

namespace App\Http\Controllers;

use App\Email;
use App\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function index() {
        return response()->json(['Email'=>Email::all()]);
    }

    public function findByUserId($user_id) {
        return response()->json([Email::where('user_id', $user_id)->get()]);
    }

    public function store(Request $request) {
        return response()->json(['Email'=>Email::create($request->all())]);
    }

    public function emailActiveUsers(Request $request) {
      $email = Email::create($request->all());
      $users = User::where('suspended', 0)->get();

      $email->scheduled = count($users);
      $peopleSent = 0;

      foreach ($users as $user) {
        try {
          $user->emails()->attach($email->id);
          $user->save();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        $peopleSent++;
      }
      $email->people_sent = $peopleSent;
      $email->save();
    }

    public function show(Email $email) {
        return response()->json(['Email'=>$email]);
    }

    public function edit(Email $email) {
        //
    }

    public function update(Request $request, Email $email) {
        $email->update($request->all());
        return response()->json(['Email'=>$email]);
    }


    public function destroy($email_id) {
        $email = Email::find($email_id);
        $email->delete();
        return response()->json(['Email'=>$email]);
    }
}
