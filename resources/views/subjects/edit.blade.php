@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Subject</h1>
    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
