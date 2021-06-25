<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $statuses = DB::table('tasks')
                        ->select('status')
                        ->distinct()
                        ->get()
                        ->pluck('status');

        $user_names = DB::table('tasks')
                        ->join('users', 'tasks.user_id', '=', 'users.id')
                        ->select('user_id', 'users.name')
                        ->distinct()
                        ->get();

        $tasks = Task::query();

        if($request->filled('status')) {
            $tasks->where('status', $request->status);
        }

        if($request->filled('user_id')) {
            $tasks->where('user_id', $request->user_id);
        }

        $selected_id = [];
        $selected_id['status'] = $request->status;
        $selected_id['user_id'] = $request->user_id;

        return view('tasks.index',[
            'tasks' => $tasks->get(),
            'statuses' => $statuses,
            'user_names' => $user_names
        ], compact('selected_id'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        Task::create($input);
        return redirect(route('tasks'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $task->task_name = $request->get('task_name');
        $task->status = $request->get('status');
        $task->save();
        return redirect(route('tasks'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('tasks'));
    }

}
