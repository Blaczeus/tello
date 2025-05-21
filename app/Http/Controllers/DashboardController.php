<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status', null);

        $query = $user->tasks();

        $tasks = $query->latest()->take(5)->get();

        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
            'taskStats' => [
                'completed' => $user->tasks()->where('status', 'completed')->count(),
                'pending' => $user->tasks()->where('status', 'pending')->count(),
                'overdue' => $user->tasks()->where('due_date', '<', now())->where('status', 'pending')->count(),
                'upcoming' => $user->tasks()->where('due_date', '>=', now())->where('status', 'pending')->count(),
                'total' => $user->tasks()->count(),
            ],
        ]);
    }
}
