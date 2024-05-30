<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use PDF;

class StudentApiController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function show($id)
    {
        $student = Student::with(['results.subject'])->find($id);

        if ($student) {
            // Transform the results to include the subject name
            $student->results->transform(function ($result) {
                return [
                    'id' => $result->id,
                    'student_id' => $result->student_id,
                    'subject_id' => $result->subject_id,
                    'subject_name' => $result->subject->name,  // Include the subject name
                    'marks' => $result->marks,
                    'created_at' => $result->created_at,
                    'updated_at' => $result->updated_at,
                ];
            });

            return response()->json($student);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

    public function generatePdf($id)
    {
        $student = Student::findOrFail($id);
        $pdf = PDF::loadView('result_pdf', compact('student'));
        return $pdf->stream('result.pdf');
    }
}
