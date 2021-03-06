<?php

namespace App\Http\Controllers;

use App\ToDoList;
use App\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ToDoListController extends Controller
{

    public function index() {
        return response()->json(['toDoList'=>ToDoList::with('tasks')->get()]);
    }

    public function getListsByUserId($user_id) {
        return response()->json(['toDoList'=>ToDoList::with('tasks')->where('user_id', $user_id)->get()]);
    }

    public function getAllWithTasksAndCount() {
      $lists = ToDoList::with('tasksCount')->with('tasks')->with('user')->get();
      return response()->json(['lists'=>$lists]);
    }

    public function findListByUsername($userEmail) {
        return response()->json([
                                'toDoList'=>ToDoList::with('tasks')->whereHas('User', function($query) use ($userEmail){
                                    $query->where('email', $userEmail);
                                })->get()
                              ]);
    }

    public function countLists() {
        return response()->json(['listsCount'=>ToDoList::count()]);
    }

    public function countCreatedYesterday() {
        $yesterday = Carbon::now()->subDay()->toDateString();
        return Response()->json(['yesterdayLists'=>ToDoList::where('created_at', 'LIKE', "%$yesterday%")->count()]);
    }

    public function countUserLists($id) {
        return response()->json(['listsCount'=>ToDoList::where('user_id', $id)->count()]);
    }


    public function store(Request $request) {
        return response()->json(['toDoList'=>ToDoList::create($request->all())]);
    }

    public function createCopyTasks(Request $request, $id) {
        $newToDoList = new ToDoList;
        $newToDoList = ToDoList::create($request->all());

        $toDoList = ToDoList::where('id', $id)->with('tasks')->get();

        foreach ($toDoList[0]->tasks as $task) {
          $newTask = new Task;
          $newTask = $task->replicate();

          $newTask->to_do_list_id = $newToDoList->id;
          $newTask->save();
        }

        return response()->json(['list'=>$newToDoList]);
    }


    public function show(ToDoList $toDoList) {
        return response()->json(['toDoList'=>$toDoList]);
    }


    public function edit(ToDoList $toDoList) {
       return response()->json(['toDoList'=>$toDoList]);
    }


    public function update(Request $request, ToDoList $toDoList) {
        $toDoList->update($request->all());
        return response()->json(['toDoList'=>$toDoList]);
    }


    public function destroy($list_id) {
        $toDoList = ToDoList::find($list_id);
        $toDoList->delete();
        return response()->json(['toDoList'=>$toDoList]);
    }
}
