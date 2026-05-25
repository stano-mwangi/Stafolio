<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Project: ') . $project->title }}
            </h2>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                ← Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($errors->any())
                <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900 rounded-lg">
                    <h3 class="font-semibold text-red-800 dark:text-red-200 mb-2">Validation Errors</h3>
                    <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Project Details Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white">
                    <h3 class="text-lg font-semibold mb-6">Project Details</h3>
                    
                    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Project Title *</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Short Description -->
                        <div>
                            <label for="short_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Short Description *</label>
                            <textarea id="short_description" name="short_description" rows="2" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('short_description', $project->short_description) }}</textarea>
                            @error('short_description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Description *</label>
                            <textarea id="description" name="description" rows="6" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category *</label>
                                <select id="category_id" name="category_id" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Project Type -->
                            <div>
                                <label for="project_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Project Type *</label>
                                <select id="project_type" name="project_type" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @foreach($projectTypes as $key => $label)
                                        <option value="{{ $key }}" {{ old('project_type', $project->project_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('project_type')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                                <select id="status" name="status" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @foreach($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', $project->status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Featured -->
                            <div class="flex items-end">
                                <label for="featured" class="flex items-center gap-2">
                                    <input type="hidden" name="featured" value="0">
                                    <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:focus:ring-blue-400 dark:bg-gray-700">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Featured Project</span>
                                </label>
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Thumbnail Image</label>
                            @if($project->thumbnail)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="h-32 w-32 object-cover rounded-lg">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Current thumbnail</p>
                                </div>
                            @endif
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upload a new thumbnail to replace the current one</p>
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- GitHub URL -->
                            <div>
                                <label for="github_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">GitHub URL</label>
                                <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $project->github_url) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('github_url')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Live URL -->
                            <div>
                                <label for="live_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Live URL</label>
                                <input type="url" id="live_url" name="live_url" value="{{ old('live_url', $project->live_url) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('live_url')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Technologies -->
                        <div>
                            <label for="technologies" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Technologies (comma-separated)</label>
                            <input type="text" id="technologies" name="technologies" value="{{ old('technologies', $project->technologies ? implode(', ', $project->technologies) : '') }}" placeholder="Laravel, React, TailwindCSS" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Separate each technology with a comma: <code class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">Laravel, React, TailwindCSS</code></p>
                        </div>

                        <!-- Submit -->
                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                Update Project
                            </button>
                            <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-700 text-gray-900 dark:text-white rounded-lg font-medium transition-colors">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Project Sections -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Content Sections</h3>
                        <button onclick="document.getElementById('addSectionForm').classList.toggle('hidden')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                            + Add Section
                        </button>
                    </div>

                    <!-- Add Section Form -->
                    <div id="addSectionForm" class="hidden mb-8 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600">
                        <form method="POST" action="{{ route('admin.sections.store') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="section_type" class="block text-sm font-medium mb-2">Section Type *</label>
                                    <select id="section_type" name="section_type" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-600">
                                        <option value="">Select type</option>
                                        @foreach($sectionTypes as $type => $label)
                                            <option value="{{ $type }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="title" class="block text-sm font-medium mb-2">Title</label>
                                    <input type="text" id="title" name="title" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-600">
                                </div>
                            </div>

                            <div>
                                <label for="content" class="block text-sm font-medium mb-2">Content</label>
                                <textarea id="content" name="content" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-600"></textarea>
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium mb-2">Image</label>
                                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-600">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Max file size: 2MB. Formats: JPG, PNG, WebP</p>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex gap-2">
                                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                                    Add Section
                                </button>
                                <button type="button" onclick="document.getElementById('addSectionForm').classList.toggle('hidden')" class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-lg font-medium">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Existing Sections -->
                    @if($project->sections->count() > 0)
                        <div class="space-y-4">
                            @foreach($project->sections as $section)
                                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $section->title ?? 'Untitled' }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Type: {{ $sectionTypes[$section->section_type] ?? $section->section_type }}</p>
                                        @if($section->content)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($section->content, 100) }}</p>
                                        @endif
                                    </div>
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.sections.destroy', $section) }}" class="inline" onsubmit="return confirm('Delete this section?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm font-medium">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-6">No sections yet. Add your first section above!</p>
                    @endif
                </div>
            </div>

            <!-- Delete Project -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500">
                <div class="p-6 text-gray-900 dark:text-white">
                    <h3 class="text-lg font-semibold mb-4">Danger Zone</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Once you delete a project, there is no going back. Please be certain.</p>
                    
                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline" onsubmit="return confirm('Are you absolutely sure? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                            Delete Project
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
