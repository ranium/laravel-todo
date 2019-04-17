@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Todo</div>
            <div class="card-body">
                @include('todos.save-form')
            </div>
        </div>
    </div>
</div>
@endsection
