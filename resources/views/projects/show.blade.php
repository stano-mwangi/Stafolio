<x-public-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Back Button -->
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 mb-8 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Projects
            </a>

            <!-- Hero Section -->
            <div class="mb-12">
                @if($project->thumbnail)
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl mb-8 h-96 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600">
                        <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Meta -->
                    <div class="flex flex-wrap items-center gap-3">
                        @if($project->category)
                            <span class="px-4 py-2 rounded-full text-sm font-medium text-white" style="background-color: {{ $project->category->color }}">
                                @if($project->category->icon)
                                    <span class="mr-1">{{ $project->category->icon }}</span>
                                @endif
                                {{ $project->category->name }}
                            </span>
                        @endif
                        
                        @if($project->featured)
                            <span class="px-4 py-2 rounded-full text-sm font-bold bg-yellow-400 text-gray-900">
                                ⭐ Featured
                            </span>
                        @endif

                        <span class="px-4 py-2 rounded-full text-sm font-medium bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                            {{ ucfirst(str_replace('_', ' ', $project->project_type)) }}
                        </span>

                        <span class="px-4 py-2 rounded-full text-sm font-medium bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-5xl font-bold text-gray-900 dark:text-white">
                        {{ $project->title }}
                    </h1>

                    <!-- Description -->
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        {{ $project->short_description }}
                    </p>

                    <!-- Technologies -->
                    @if($project->technologies && count($project->technologies) > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->technologies as $tech)
                                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full text-sm font-medium">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 pt-4">
                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6a4 4 0 11-8 0 4 4 0 018 0zM12.9 15C11.8 15 10.9 15.9 10.9 17v5h10.2v-5c0-1.1-.9-2-2-2h-6.2z" />
                                </svg>
                                View Live Demo
                            </a>
                        @endif
                        
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                                View on GitHub
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <hr class="border-gray-300 dark:border-gray-600 my-12">

            <!-- Main Content Sections -->
            <div class="prose dark:prose-invert max-w-none mb-12">
                @if($project->sections->count() > 0)
                    @foreach($project->sections as $section)
                        <x-project-section :section="$section" />
                    @endforeach
                @else
                    <div class="text-gray-600 dark:text-gray-400">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Description</h2>
                        {!! nl2br(e($project->description)) !!}
                    </div>
                @endif
            </div>

            <!-- Media Gallery -->
            @if($project->media->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Gallery</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($project->media as $media)
                            <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all">
                                @if($media->type === 'image')
                                    <img src="{{ Storage::url($media->path) }}" alt="{{ $media->alt_text }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                                @if($media->caption)
                                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex items-end">
                                        <p class="text-white text-sm">{{ $media->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <hr class="border-gray-300 dark:border-gray-600 my-12">

            <!-- Related Projects -->
            @if($relatedProjects->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Related Projects</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedProjects as $related)
                            <x-project-card :project="$related" />
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 rounded-2xl p-12 text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Want to work on something like this?</h2>
                <p class="text-lg opacity-90 mb-6 max-w-2xl mx-auto">
                    I'm always interested in new projects and collaborations. Let's connect and create something amazing together.
                </p>
                <a href="{{ route('contact') }}" class="inline-block px-8 py-3 bg-white hover:bg-gray-100 text-blue-600 font-bold rounded-lg transition-colors">
                    Get In Touch
                </a>
            </div>
        </div>
    </div>
</x-public-layout>