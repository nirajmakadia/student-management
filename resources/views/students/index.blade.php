@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
                <th>Export</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                   @if(!$student->trashed()) 
                    <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                    <td>
                        <a href="{{ route('students.export', ['student' => $student->id, 'format' => 'pdf']) }}" class="btn btn-primary">Export PDF</a>
                        <a href="{{ route('students.export', ['student' => $student->id, 'format' => 'excel']) }}" class="btn btn-success">Export Excel</a>
                    </td>
                    @else
                    <td><a href="{{ route('students.hardDelete', ['id' => $student->id]) }}" class="btn btn-danger">Delete Permanently </a></td>
                    <td> </td>            
                    @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
