<?php

namespace App\Http\Controllers\Todos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Todos\SaveTodoRequest;
use App\Todo;
use App\Jobs\Todos\CreateTodo;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TodoRepositoryInterface $todoRepo)
    {
        return view('todos.index', [
            'todos' => $todoRepo->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Todos\SaveTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTodoRequest $request)
    {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
