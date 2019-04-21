<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

// Routes for auth pages
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Authenticated routes
Route::group(
    ['middleware' => ['auth']],
    function () {
        // Add/edit/delete/show routes for Todos
        Route::resource('todo', 'Todos\TodoController');

        // Route to mark a todo complete
        Route::post(
            'todo/{todo}/complete',
            'Todos\MarkTodoCompletedController@store'
        )->name('todo.complete');

        // Route to mark a todo pending
        Route::delete(
            'todo/{todo}/complete',
            'Todos\MarkTodoCompletedController@destroy'
        )->name('todo.pending');
    }
);

