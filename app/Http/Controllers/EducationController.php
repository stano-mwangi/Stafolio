<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of education entries.
     */
    public function index()
    {
        $education = Education::orderBy('year_from', 'desc')->get();
        return view('dashboard', compact('education'));
    }

    /**
     * Show the form for creating a new education entry.
     */
    public function create()
    {
        return view('admin.education.create');
    }

    /**
     * Store a newly created education entry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'year_from' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'year_to' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'description' => 'nullable|string',
        ]);

        Education::create($validated);

        return redirect()->route('dashboard')->with('success', 'Education entry created successfully!');
    }

    /**
     * Show the form for editing the specified education entry.
     */
    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    /**
     * Update the specified education entry.
     */
    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'year_from' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'year_to' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'description' => 'nullable|string',
        ]);

        $education->update($validated);

        return redirect()->route('dashboard')->with('success', 'Education entry updated successfully!');
    }

    /**
     * Remove the specified education entry.
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('dashboard')->with('success', 'Education entry deleted successfully!');
    }
}
