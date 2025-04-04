<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Show only incomplete tasks by default
        $tasks = Task::where('completed', false)->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tasks,name',
        ], [
            'name.required' => 'Please enter a task name.',
            'name.unique' => 'This task already exists.',
        ]);

        Task::create([
            'name' => $request->name,
            'completed' => false,
        ]);

        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = true;
        $task->save();

        return redirect()->back();
    }

    public function showAll()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }
}
