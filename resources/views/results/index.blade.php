@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Results</h1>
    <a href="{{ route('results.create') }}" class="btn btn-primary">Add Result</a>
    <table class="table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result->student->name }}</td>
                <td>{{ $result->subject->name }}</td>
                <td>{{ $result->marks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
