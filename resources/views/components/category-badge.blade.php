@props(['category', 'selected' => false])

<a href="{{ route('projects.index', ['category' => $category->slug]) }}" 
   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ $selected ? 'ring-2 ring-offset-2 ring-blue-500' : '' }}"
   style="background-color: {{ $category->color }}20; border: 1px solid {{ $category->color }}; color: {{ $category->color }};">
    @if($category->icon)
        <span class="text-lg">{{ $category->icon }}</span>
    @endif
    <span>{{ $category->name }}</span>
    @if($category->projects_count ?? false)
        <span class="text-xs opacity-70 font-semibold">({{ $category->projects_count }})</span>
    @endif
</a>
