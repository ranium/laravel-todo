@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Todos</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Due At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $todo->title }}</td>
                                <td>{{ $todo->due_at ?  $todo->due_at->format('j, M Y') : ''}}</td>
                                <td>
                                    <a href="{{ route('todo.complete', ['todo' => $todo->id]) }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('todo-complete-form-{{ $todo->id }}').submit();">
                                        {{ __('Complete') }}
                                    </a> |
                                    <a href="#">{{ __('Delete') }}</a>
                                    <form id="todo-complete-form-{{ $todo->id }}"
                                        action="{{ route('todo.complete', ['todo' => $todo->id]) }}" method="POST" style="display: none;">
                                            {{ method_field('PUT') }}
                                            @csrf
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>
    </div>
</div>
@endsection
