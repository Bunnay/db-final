<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Task $task)
    {
        return $user -> id === $task -> user_id || $task->status == 'public';
    }

    public function update(User $user, Task $task)
    {
        return $user -> id === $task -> user_id;
    }

    public function delete(User $user, Task $task)
    {
        return $user -> id === $task -> user_id;
    }

}
