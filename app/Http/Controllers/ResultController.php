<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('results.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|string|max:255',
            'marks' => 'required|integer|min:0|max:100',
        ]);

        Result::create($request->all());
        return redirect()->route('results.index');
    }

    public function index()
    {
        $results = Result::with('student')->get();
        return view('results.index', compact('results'));
    }
}
