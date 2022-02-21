<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;

class TasksController extends Controller
{
    public function index(Request $request)
    {

        $tasks = Task::with(['user', 'categories'])
            ->when($request->query('status'), function ($query) use ($request) {
                return $query->where('status', $request->query('status'));
            })
            ->when($request->query('user_id'), function ($query) use ($request) {
                return $query->where('user_id', $request->query('user_id'));
            })
            ->when($request->query('category_ids'), function ($query) use ($request) {
                return $query->where('category_ids', $request->query('category_ids'));
            })
            ->get();

        $users = User::all();
        $categories = Category::all();

        return view('tasks.index',[
            'tasks' => $tasks,
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $task = Task::create($input);
        $task->save();
        $task->categories()->attach($input["category_ids"]);
        return redirect(route('tasks'));
    }

    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('tasks.edit', [
            'task' => $task,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $task->task_name = $request->get('task_name');
        $task->status = $request->get('status');
        $task->categories()->sync($request->category_ids);
        $task->save();
        return redirect(route('tasks'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('tasks'));
    }

}
