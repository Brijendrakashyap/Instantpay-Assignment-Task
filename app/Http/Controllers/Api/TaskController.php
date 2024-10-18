<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Retrieve tasks
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    // Display a specific task
    public function show(Task $task)
    {
        return response()->json($task, 200);
    }

     // Store a new task
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'board_id' => 'required|exists:boards,id',
            'completed' => 'sometimes|boolean',
        ]);
    
        // Create a new task with the validated data  
        $task = Task::create($validated);
    
        return response()->json([
            'message' => 'Task created successfully.',
            'task' => $task,
        ], 201);
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        // Validate the incoming data for updating the task
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        // Update the task with the validated data
        $task->update($validated);

        return response()->json([
            'message' => 'Task updated successfully.',
            'task' => $task,
        ]);
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully.'
        ], 204);
    }
}
