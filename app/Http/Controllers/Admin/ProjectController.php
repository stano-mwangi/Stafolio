<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Show all projects in admin
     */
    public function index()
    {
        $projects = Project::with('category')
                           ->latest()
                           ->paginate(20);
        
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show form to create a new project
     */
    public function create()
    {
        $categories = ProjectCategory::all();
        $projectTypes = [
            'web_app' => 'Web Application',
            'ml' => 'Machine Learning',
            'cybersecurity' => 'Cybersecurity',
            'design' => 'Design / Branding',
            'data_analysis' => 'Data Analysis',
            'api' => 'API / Backend'
        ];
        $statuses = ['completed' => 'Completed', 'in_progress' => 'In Progress', 'archived' => 'Archived'];
        
        return view('admin.projects.create', compact('categories', 'projectTypes', 'statuses'));
    }

    /**
     * Store a newly created project
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        $project = Project::create($data);

        return redirect()->route('admin.projects.edit', $project)
                        ->with('success', 'Project created successfully!');
    }

    /**
     * Show form to edit a project
     */
    public function edit(Project $project)
    {
        $project->load('sections', 'media');
        $categories = ProjectCategory::all();
        $projectTypes = [
            'web_app' => 'Web Application',
            'ml' => 'Machine Learning',
            'cybersecurity' => 'Cybersecurity',
            'design' => 'Design / Branding',
            'data_analysis' => 'Data Analysis',
            'api' => 'API / Backend'
        ];
        $statuses = ['completed' => 'Completed', 'in_progress' => 'In Progress', 'archived' => 'Archived'];
        $sectionTypes = \App\Models\ProjectSection::getSectionTypes();
        
        return view('admin.projects.edit', compact('project', 'categories', 'projectTypes', 'statuses', 'sectionTypes'));
    }

    /**
     * Update the specified project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.edit', $project)
                        ->with('success', 'Project updated successfully!');
    }

    /**
     * Delete a project
     */
    public function destroy(Project $project)
    {
        // Delete thumbnail
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        // Delete related sections and media
        $project->sections()->delete();
        $project->media()->each(function ($media) {
            if ($media->path) {
                Storage::disk('public')->delete($media->path);
            }
        });
        $project->media()->delete();

        $project->delete();

        return redirect()->route('admin.projects.index')
                        ->with('success', 'Project deleted successfully!');
    }

    /**
     * Reorder projects
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:projects,id'
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Project::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['message' => 'Projects reordered successfully']);
    }
}
