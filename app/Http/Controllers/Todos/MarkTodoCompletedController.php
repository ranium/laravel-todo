<?php

namespace App\Http\Controllers\Todos;

use App\Todo;
use Illuminate\Http\Request;
use App\Jobs\Todos\MarkTodoPending;
use App\Http\Controllers\Controller;
use App\Jobs\Todos\MarkTodoCompleted;


class MarkTodoCompletedController extends Controller
{

    /**
     * Method to mark a todo as completed
     *
     * @param Request $request
     * @param Todo $todo
     * @return void
     */
    public function store(Request $request, Todo $todo)
    {
        // Check if the user can update the todo
        $this->authorize('update', $todo);

        // Mark the todo completed
        dispatch_now(new MarkTodoCompleted($todo, $request->user()));

        // Return back to previous page
        return redirect()->back()->with('successMessage', __('Todo completed.'));
    }

    /**
     * Method to mark a todo as open
     *
     * @param Request $request
     * @param Todo $todo
     * @return void
     */
    public function destroy(Request $request, Todo $todo)
    {
        // Check if the user can update the todo
        $this->authorize('update', $todo);

        // Mark the todo pending
        dispatch_now(new MarkTodoPending($todo, $request->user()));

        // Return back to previous page
        return redirect()->back()->with('successMessage', __('Todo marked as pending.'));
    }
}
