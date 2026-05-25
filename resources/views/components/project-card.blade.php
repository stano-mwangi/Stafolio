@props(['project'])

<div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700">
    <!-- Image Container -->
    <div class="relative h-48 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 overflow-hidden">
        @if($project->thumbnail)
            <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        
        <!-- Category Badge -->
        @if($project->category)
            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm" style="border: 1px solid {{ $project->category->color }}; color: {{ $project->category->color }}">
                    @if($project->category->icon)
                        <span class="mr-1">{{ $project->category->icon }}</span>
                    @endif
                    {{ $project->category->name }}
                </span>
            </div>
        @endif

        <!-- Featured Badge -->
        @if($project->featured)
            <div class="absolute top-3 left-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-400 text-gray-900">
                    ⭐ Featured
                </span>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
            {{ $project->title }}
        </h3>
        
        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-4">
            {{ $project->short_description ?? $project->description }}
        </p>

        <!-- Technologies -->
        @if($project->technologies && count($project->technologies) > 0)
            <div class="mb-4 flex flex-wrap gap-2">
                @foreach(array_slice($project->technologies, 0, 3) as $tech)
                    <span class="text-xs bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-2 py-1 rounded-full font-medium">
                        {{ $tech }}
                    </span>
                @endforeach
                @if(count($project->technologies) > 3)
                    <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-1 rounded-full font-medium">
                        +{{ count($project->technologies) - 3 }} more
                    </span>
                @endif
            </div>
        @endif

        <!-- Links -->
        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('projects.show', $project) }}" class="flex-1 text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                View Project
            </a>
            
            @if($project->live_url || $project->github_url)
                <div class="flex gap-2">
                    @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="p-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors" title="Live Demo">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 6a4 4 0 11-8 0 4 4 0 018 0zM12.9 15C11.8 15 10.9 15.9 10.9 17v5h10.2v-5c0-1.1-.9-2-2-2h-6.2z" />
                            </svg>
                        </a>
                    @endif
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="p-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors" title="GitHub">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
