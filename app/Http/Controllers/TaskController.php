<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Task::where('user_id', $userId);

        // Search by keyword in title
        if ($request->has('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        // Paginate results
        $tasks = $query->paginate(10);

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
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return response()->json([
                'errors' => $errors,
            ], 400);
        } else {
            $task = Auth::user()->tasks()->create($request->all());
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
        $task = Auth::user()->tasks()->findOrFail($id);
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
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->update($request->all());
        return response()->json($task, 201);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function markAsCompleted($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->update(['status' => 'completed']);
        return response()->json(['message' => 'Task marked as completed']);
    }

    public function userTasks()
    {
        $userId = Auth::id();

        $completedTasksCount = Task::where('user_id', $userId)->where('status', 'completed')->count();
        $pendingTasksCount = Task::where('user_id', $userId)->where('status', '!=', 'completed')->count();
        $allTasksCount = Task::where('user_id', $userId)->count();

        return response()->json([
            'completed_tasks_count' => $completedTasksCount,
            'pending_tasks_count' => $pendingTasksCount,
            'all_tasks_count' => $allTasksCount,
        ]);
    }
}
