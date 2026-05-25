<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Show all projects (frontend)
     */
    public function index(Request $request)
    {
        $categories = ProjectCategory::withCount('projects')->get();
        
        $query = Project::with('category', 'sections', 'media')
                        ->where('status', 'completed');
        
        // Filter by category if provided
        if ($request->has('category') && $request->category !== '') {
            $query->byCategory($request->category);
        }
        
        // Search if provided
        if ($request->has('search') && $request->search !== '') {
            $query->search($request->search);
        }
        
        $projects = $query->paginate(12);
        $featured = Project::featured()->with('category')->limit(3)->get();
        
        return view('projects', compact('projects', 'categories', 'featured'));
    }

    /**
     * Show a single project detail
     */
    public function show(Project $project)
    {
        $project->load('category', 'sections', 'media');
        $relatedProjects = Project::where('category_id', $project->category_id)
                                   ->where('id', '!=', $project->id)
                                   ->limit(3)
                                   ->get();
        
        return view('projects.show', compact('project', 'relatedProjects'));
    }

    /**
     * Get all projects for API
     */
    public function getAll()
    {
        return Project::with('category', 'sections', 'media')
                      ->where('status', 'completed')
                      ->get();
    }
}
