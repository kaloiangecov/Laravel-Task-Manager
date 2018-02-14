<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function index() {
        return response()->json(['Tasks'=>Task::all()]);
    }

    public function findByListId($id) {
        return response()->json(['Task'=>Task::where('to_do_list_id', $id)->get()]);
    }

    public function findByListIdActiveOnly($toDoListId) {
        return response()->json(['Tasks'=>Task::where('completed', 0)
                                              ->where('to_do_list_id', $toDoListId)->get()]);
    }

    public function countOpenTasks() {
        return response()->json(['openTasks'=>Task::where('completed', 0)->count()]);
    }

    public function countClosedTasks() {
        return response()->json(['closedTasks'=>Task::where('completed', 1)->count()]);
    }

    public function countCreatedYesterday() {
        $yesterday = Carbon::now()->subDay()->toDateString();
        return Response()->json(['yesterdayTasks'=>Task::where('created_at', 'LIKE', "%$yesterday%")->count()]);
    }

    public function store(Request $request) {
        return response()->json(['Task'=>Task::create($request->all())]);
    }

    public function show(Task $task) {
        return response()->json(['Task'=>$task]);
    }

    public function edit(Task $task) {
        return response()->json(['Task'=>$task]);
    }

    public function update(Request $request, Task $task) {
        $task->update($request->all());
        return response()->json(['Task'=>$task]);
    }

    public function destroy($task_id) {
        $task = Task::find($task_id);
        $task->delete();
        return response()->json(['Task'=>$task]);
    }
}
