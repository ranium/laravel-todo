@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@include('partials.form.errors')
<form method="POST" action="{{ $todo->id ? route('todo.update', ['todo' => $todo->id]) : route('todo.store') }}">
    @if ($todo->id)
        @method('PUT')
    @endif
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">{{ __('Title') }}</label>
        <input type="text"
            class="form-control"
            name="title"
            id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="{{ __('Title') }}"
            value="{{ old('title', $todo->title) }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">{{ __('Desscription') }}</label>
        <textarea class="form-control"
            name="description"
            cols="30"
            rows="3">{{ old('description', $todo->description) }}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">{{ __('Due Date') }}</label>
        <input type="date"
            class="form-control"
            placeholder="Due Date"
            name="due_at"
            value="{{ old('due_at', $todo->due_at ? $todo->due_at->format('Y-m-d') : '') }}">
    </div>
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
</form>
