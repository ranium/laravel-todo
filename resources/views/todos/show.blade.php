@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $todo->title }}</h5>
                <p class="card-text">{{ $todo->description }}</p>
                <a href="{{ route('todo.edit', ['todo' => $todo->id]) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('todo.complete', ['todo' => $todo->id]) }}"
                    class="btn btn-secondary"
                    onclick="event.preventDefault();
                        document.getElementById('todo-complete-form-{{ $todo->id }}').submit();">
                    @if($todo->completed_at)
                        {{ __('Not Complete') }}
                    @else
                        {{ __('Complete') }}
                    @endif
                </a>
                <a href="{{ route('todo.destroy', ['todo' => $todo->id]) }}"
                    class="btn btn-danger"
                    onclick="event.preventDefault();
                        document.getElementById('todo-destroy-form-{{ $todo->id }}').submit();">
                    Delete
                </a>
            </div>
        </div>
    </div>
</div>
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
@endsection
