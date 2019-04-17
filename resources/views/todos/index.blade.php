@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Todos <a class="float-right" href="{{ route('todo.index', ['all' => 1]) }}">Show All</a></div>
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
                                <td><a class="{{ $todo->completed_at ? 'completed' : '' }}" href="{{ route('todo.show', ['todo' => $todo->id]) }}">{{ $todo->title }}</a></td>
                                <td>{{ $todo->due_at ?  $todo->due_at->format('j, M Y') : '-'}}</td>
                                <td>
                                    <a href="{{ route('todo.edit', ['todo' => $todo->id]) }}">{{ __('Edit') }}</a>
                                     |
                                    <a href="{{ route('todo.complete', ['todo' => $todo->id]) }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('todo-complete-form-{{ $todo->id }}').submit();">
                                        @if($todo->completed_at)
                                            {{ __('Not Complete') }}
                                        @else
                                            {{ __('Complete') }}
                                        @endif
                                    </a> |
                                    <a href="{{ route('todo.destroy', ['todo' => $todo->id]) }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('todo-destroy-form-{{ $todo->id }}').submit();">
                                    {{ __('Delete') }}</a>
                                    <form id="todo-complete-form-{{ $todo->id }}"
                                        action="{{ route('todo.complete', ['todo' => $todo->id]) }}" method="POST" style="display: none;">
                                            @if($todo->completed_at)
                                                @method('DELETE')
                                            @else
                                                @method('POST')
                                            @endif
                                            @csrf
                                    </form>
                                    <form id="todo-destroy-form-{{ $todo->id }}"
                                        action="{{ route('todo.destroy', ['todo' => $todo->id]) }}" method="POST" style="display: none;">
                                            @method('DELETE')
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
