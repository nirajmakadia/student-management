<?php

namespace App\Http\Controllers;
use App\Models\Subject;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($request->all());
        return redirect()->route('subjects.index');
    }

    public function show(Subject $Subject)
    {
        return view('subjects.show', compact('Subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $Subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $Subject->update($request->all());
        return redirect()->route('subjects.index');
    }

    public function destroy(Subject $Subject)
    {
        $Subject->delete();
        return redirect()->route('subjects.index');
    }


}
