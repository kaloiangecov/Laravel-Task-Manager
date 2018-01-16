<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['Tasks'=>Task::all()]);
    }

    public function findByListId($id)
    {
        return response()->json(['Task'=>Task::where('to_do_list_id', $id)->get()]);
    }

    public function findByListIdActiveOnly($toDoListId)
    {
        return response()->json(['Tasks'=>Task::where('completed', 0)
                                              ->where('to_do_list_id', $toDoListId)->get()]);
    }

    public function countOpenTasks()
    {
        return response()->json(['openTasks'=>Task::where('completed', 0)->count()]);
    }

    public function countClosedTasks()
    {
        return response()->json(['openTasks'=>Task::where('completed', 1)->count()]);
    }

    public function countCreatedYesterday()
    {
        $yesterday = Carbon::now()->subDay()->toDateString();
        return Response()->json(['yesterdayTasks'=>Task::where('created_at', 'LIKE', "%$yesterday%")->count()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['Task'=>Task::create($request->all())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json(['Task'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return response()->json(['Task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return response()->json(['Task'=>$task]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['Task'=>$task]);
    }
}
