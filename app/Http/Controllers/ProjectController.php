<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Show all projects
     */
    public function index()
    {
        $projects = Project::all();
        return view('dashboard', compact('projects'));
    }

    /**
     * Show form to create a new project
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        Project::create($validated);

        return redirect()->route('dashboard')->with('success', 'Project created successfully!');
    }

    /**
     * Show form to edit a project
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $project->update($validated);

        return redirect()->route('dashboard')->with('success', 'Project updated successfully!');
    }

    /**
     * Delete a project
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully!');
    }

    /**
     * Get all projects for API
     */
    public function getAll()
    {
        return Project::all();
    }
}
