@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Result</h1>
    <form action="{{ route('results.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student">Student</label>
            <select name="student_id" id="student" class="form-control" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">Select Student</option>
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="marks">Marks</label>
            <input type="number" name="marks" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>

    <div id="student-results" style="margin-top: 20px;">
        <h3>Student Results</h3>
        <ul id="results-list"></ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#student').change(function() {
        var studentId = $(this).val();
        if (studentId) {
            $.ajax({
                url: '/api/students/' + studentId,
                type: 'GET',
                success: function(data) {
                    $('#results-list').empty();

                    if (data.results.length > 0) {
                        data.results.forEach(function(result) {
                            $('#results-list').append('<li>' + result.subject_name + ': ' + result.marks + '</li>');
                        });
                    } else {
                        $('#results-list').append('<li>No results found for this student.</li>');
                    }
                },
                error: function() {
                    $('#results-list').empty();
                    $('#results-list').append('<li>Error fetching student results.</li>');
                }
            });
        } else {
            $('#results-list').empty();
        }
    });
});
</script>
@endsection
