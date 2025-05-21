<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Filters\TaskFilters;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
    
        $query = (new TaskFilters($request))->apply($user->tasks());
    
        $tasks = $query->latest()->paginate(10)->withQueryString();
    
        $counts = [
            'all' => $user->tasks()->count(),
            'todo' => $user->tasks()->where('status', 'new')->count(),
            'in_progress' => $user->tasks()->where('status', 'pending')->count(),
            'completed' => $user->tasks()->where('status', 'completed')->count(),
        ];
    
        $status = $request->get('status', 'all');
    
        return inertia('Tasks/Index', [
            'tasks' => $tasks,
            'counts' => $counts,
            'active' => $status,
        ]);
    }    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        $request->user()->tasks()->create([
            ...$validated,
            'status' => 'new',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return Inertia::render('Tasks/Show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return Inertia::render('Tasks/Edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // $this->authorize('update', $task);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        $task->status = $validated['status'];
        $task->save();

        return back()->with('success', 'Task status updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
