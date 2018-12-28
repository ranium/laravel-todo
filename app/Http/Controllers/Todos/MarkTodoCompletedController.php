<?php

namespace App\Http\Controllers\Todos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Todo;
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
    public function update(Request $request, Todo $todo)
    {
        // Check if the user can update the todo
        $this->authorize('update', $todo);

        // Mark the todo completed
        dispatch_now(new MarkTodoCompleted($todo, $request->user()));

        // Return back to previous page
        return redirect()->back()->with('successMessage', __('Todo completed.'));
    }
}
