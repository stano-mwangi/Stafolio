<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectCategoryRequest;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    /**
     * Show all categories
     */
    public function index()
    {
        $categories = ProjectCategory::withCount('projects')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show form to create category
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a new category
     */
    public function store(StoreProjectCategoryRequest $request)
    {
        ProjectCategory::create($request->validated());

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Category created successfully!');
    }

    /**
     * Show form to edit category
     */
    public function edit(ProjectCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update category
     */
    public function update(Request $request, ProjectCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:project_categories,name,' . $category->id,
            'slug' => 'required|string|max:255|unique:project_categories,slug,' . $category->id,
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|regex:/^#[0-9A-F]{6}$/i',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Category updated successfully!');
    }

    /**
     * Delete category
     */
    public function destroy(ProjectCategory $category)
    {
        if ($category->projects()->exists()) {
            return redirect()->route('admin.categories.index')
                            ->with('error', 'Cannot delete category with projects.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Category deleted successfully!');
    }
}
