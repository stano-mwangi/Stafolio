<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of technologies.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('dashboard', compact('technologies'));
    }

    /**
     * Show the form for creating a new technology.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created technology.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
        ]);

        Technology::create($validated);

        return redirect()->route('dashboard')->with('success', 'Technology created successfully!');
    }

    /**
     * Show the form for editing the specified technology.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified technology.
     */
    public function update(Request $request, Technology $technology)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
        ]);

        $technology->update($validated);

        return redirect()->route('dashboard')->with('success', 'Technology updated successfully!');
    }

    /**
     * Remove the specified technology.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('dashboard')->with('success', 'Technology deleted successfully!');
    }
}
