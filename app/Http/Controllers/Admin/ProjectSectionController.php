<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectSectionRequest;
use App\Models\Project;
use App\Models\ProjectSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectSectionController extends Controller
{
    /**
     * Store a new section
     */
    public function store(StoreProjectSectionRequest $request)
    {
        $data = $request->validated();
        $project = Project::findOrFail($data['project_id']);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if (!$file->isValid()) {
                    return redirect()->back()
                        ->withErrors(['image' => 'The uploaded image is corrupted or invalid.'])
                        ->withInput();
                }
                $data['image'] = $file->store('projects/sections', 'public');
            }

            // Handle gallery upload
            if ($request->hasFile('gallery')) {
                $galleryPaths = [];
                foreach ($request->file('gallery') as $file) {
                    if (!$file->isValid()) {
                        return redirect()->back()
                            ->withErrors(['gallery' => 'One or more gallery images are corrupted or invalid.'])
                            ->withInput();
                    }
                    $galleryPaths[] = $file->store('projects/sections', 'public');
                }
                $data['gallery'] = $galleryPaths;
            }

            // Set sort order
            $maxOrder = ProjectSection::where('project_id', $data['project_id'])->max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;

            ProjectSection::create($data);

            return redirect()->route('admin.projects.edit', $project)
                            ->with('success', 'Section added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Update a section
     */
    public function update(Request $request, ProjectSection $section)
    {
        $validated = $request->validate([
            'section_type' => 'required|in:text,image,gallery,code,notebook_step,metrics,visualization,timeline,embedded_video,features',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'metadata' => 'nullable|array',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('projects/sections', 'public');
        }

        // Handle gallery upload
        if ($request->hasFile('gallery')) {
            $galleryPaths = $section->gallery ?? [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/sections', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }

        $section->update($validated);

        return redirect()->route('admin.projects.edit', $section->project)
                        ->with('success', 'Section updated successfully!');
    }

    /**
     * Delete a section
     */
    public function destroy(ProjectSection $section)
    {
        $project = $section->project;

        // Delete images
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }
        if ($section->gallery) {
            foreach ($section->gallery as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $section->delete();

        return redirect()->route('admin.projects.edit', $project)
                        ->with('success', 'Section deleted successfully!');
    }

    /**
     * Reorder sections
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:project_sections,id'
        ]);

        foreach ($validated['ids'] as $index => $id) {
            ProjectSection::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['message' => 'Sections reordered successfully']);
    }
}
