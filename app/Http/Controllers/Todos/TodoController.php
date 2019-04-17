<?php

namespace App\Http\Controllers\Todos;

use App\Todo;
use Illuminate\Http\Request;
use App\Jobs\Todos\CreateTodo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Todos\SaveTodoRequest;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TodoRepositoryInterface $todoRepo, Request $request)
    {
        $method = 'allPendingForUser';

        if ($request->all) {
            $method = 'allForUser';
        }

        return view('todos.index', [
            'todos' => $todoRepo->$method(auth()->user())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Todo::class);

        // Instantiate an empty todo object
        $todo = new Todo;

        return view('todos.create', compact('todo'));
    }

    /**
     * Store a newly created Todo.
     *
     * @param \App\Http\Requests\Todos\SaveTodoRequest $request Form request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTodoRequest $request)
    {
        // Check if the current user can create the todo
        $this->authorize('create', Todo::class);

        // Response will always be going back to the previous page
        $response = redirect()->back();

        // Create the todo and redirect to previous page with a success message
        if (dispatch_now(new CreateTodo($request->all(), $request->user()))) {
            return $response->with('successMessage', __('Todo has been added.'));
        }

        // Todo creation failed, redirect back with an error message
        return $response->with('errorMessage', __('There was an error in adding the Todo.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Todo $todo Todo to be edited
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);

        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Repositories\Contracts\TodoRepositoryInterface $todoRepo Todo repository instance
     * @param \App\Http\Requests\Todos\SaveTodoRequest            $request  Form request
     * @param \App\Todo                                           $todo     Todo to be updated
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRepositoryInterface $todoRepo, SaveTodoRequest $request, Todo $todo)
    {
        $updated = $todoRepo->update(
            $todo->id,
            [
                'title' => $request->title,
                'description' => $request->description,
                'due_at' => $request->due_at,
            ]
        );

        if ($updated) {
            return redirect()->back()->with('successMessage', __('Todo has been updated.'));
        }

        return redirect()->back()->with('errorMessage', __('Unable to update the todo.'));
    }

    /**
     * Remove the specified todo from storage.
     *
     * @param \App\Repositories\Contracts\TodoRepositoryInterface $todoRepo Todo repository instance
     * @param \App\Todo                                           $todo     Todo to be deleted
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoRepositoryInterface $todoRepo, Todo $todo)
    {
        // Check if the current user can delete the todo
        $this->authorize('delete', $todo);

        if ($todoRepo->delete($todo->id)) {
            return redirect()->back()->with('successMessage', __('Todo has been deleted.'));
        }

        return redirect()->back()->with('errorMessage', __('Unable to delete the todo.'));
    }
}
