<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::withTrashed()->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }

    public function hardDelete($id)
    {
        $student = Student::withTrashed()->find($id);
        $student->forceDelete();
        return redirect()->route('students.index');
    }
    public function exportData(Student $student, $format)
    {
        $results = $student->results;
        if ($format === 'pdf') {
            $pdf = PDF::loadView('pdf.student_result', compact('student', 'results'));
            return $pdf->download('student_result.pdf');
        } elseif ($format === 'excel') {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            $sheet->setCellValue('A1', 'Name');
            $sheet->setCellValue('B1', 'Email');
            $sheet->setCellValue('A2', $student->name);
            $sheet->setCellValue('B2', $student->email);
    
            $sheet->setCellValue('A4', 'Subject');
            $sheet->setCellValue('B4', 'Marks');
    
            $row = 5;
            foreach ($results as $result) {
                $sheet->setCellValue('A' . $row, $result->subject->name);
                $sheet->setCellValue('B' . $row, $result->marks);
                $row++;
            }
    
            $writer = new Xlsx($spreadsheet);
            $fileName = 'student_data.xlsx';
            $writer->save($fileName);
    
            return response()->download($fileName)->deleteFileAfterSend();
        }
        abort(404);
    }
   
}
