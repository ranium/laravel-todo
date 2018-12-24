@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('partials.form.errors')
                    <form method="POST" action="{{ route('todo.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{ __('Title') }}</label>
                          <input type="text"
                                class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="{{ __('Title') }}"
                                value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">{{ __('Desscription') }}</label>
                          <textarea class="form-control" name="description" id="" cols="30" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Due Date</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Due Date" value="{{ old('title') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
