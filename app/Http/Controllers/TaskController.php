<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::paginate(10);
        return response()->json($tasks);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'string|nullable',
            'status' => 'string|nullable',
            'due_date' => 'date|nullable',
        ], [], [
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'due_date' => 'Due Date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                // 'status' => "fail",
                'errors' => $validator->errors(),
            ]);
        } else {
            $task = new Task;
            $task->title = $request->title;
            $task->description = $request->description;
            $task->status = $request->status;
            $task->due_date = $request->due_date;
            $task->user_id = Auth::id();
            $task->save();

            return response()->json($task, 201);
        }
    }

    /**
     * Display the specified task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }
    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'string|nullable',
            'status' => 'string|nullable',
            'due_date' => 'date|nullable',
        ], [], [
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'due_date' => 'Due Date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                // 'status' => "fail",
                'errors' => $validator->errors(),
            ]);
        } else {

            $task = Task::findOrFail($id);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->status = $request->status;
            $task->due_date = $request->due_date;
            $task->update();

            return response()->json($task, 201);
        }
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function markAsCompleted($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'completed']);
        return response()->json(['message' => 'Task marked as completed']);
    }
}
