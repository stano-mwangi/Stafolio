@props(['section'])

<div class="py-8 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
    @switch($section->section_type)
        @case('text')
            <div class="prose dark:prose-invert max-w-none">
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $section->title }}</h2>
                @endif
                <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {!! nl2br(e($section->content)) !!}
                </div>
            </div>
            @break

        @case('image')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $section->title }}</h2>
                @endif
                @if($section->image)
                    <img src="{{ Storage::url($section->image) }}" alt="{{ $section->title }}" class="w-full rounded-xl shadow-lg">
                @endif
            </div>
            @break

        @case('gallery')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $section->title }}</h2>
                @endif
                @if($section->gallery && count($section->gallery) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($section->gallery as $image)
                            <div class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-shadow">
                                <img src="{{ Storage::url($image) }}" alt="Gallery image" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @break

        @case('code')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $section->title }}</h2>
                @endif
                <div class="bg-gray-900 dark:bg-gray-950 rounded-xl p-6 overflow-auto">
                    <pre class="text-sm text-gray-100 font-mono"><code>{{ $section->content }}</code></pre>
                </div>
            </div>
            @break

        @case('features')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ $section->title }}</h2>
                @endif
                @if($section->metadata && isset($section->metadata['features']))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($section->metadata['features'] as $feature)
                            <div class="flex gap-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-600 text-white">
                                        ✓
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $feature['title'] ?? '' }}</h3>
                                    @if(isset($feature['description']))
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $feature['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($section->content)) !!}
                    </div>
                @endif
            </div>
            @break

        @case('metrics')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ $section->title }}</h2>
                @endif
                @if($section->metadata && isset($section->metadata['metrics']))
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($section->metadata['metrics'] as $metric)
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 rounded-lg p-6 text-center border border-blue-200 dark:border-blue-700">
                                <div class="text-3xl md:text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $metric['value'] ?? '' }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $metric['label'] ?? '' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @break

        @case('visualization')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $section->title }}</h2>
                @endif
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    @if($section->metadata && isset($section->metadata['chart_type']))
                        <p class="text-center text-gray-600 dark:text-gray-400">[Chart: {{ $section->metadata['chart_type'] }}]</p>
                    @else
                        <p class="text-center text-gray-600 dark:text-gray-400">Visualization placeholder</p>
                    @endif
                </div>
            </div>
            @break

        @case('timeline')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ $section->title }}</h2>
                @endif
                @if($section->metadata && isset($section->metadata['events']))
                    <div class="space-y-8">
                        @foreach($section->metadata['events'] as $event)
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-4 h-4 bg-blue-600 rounded-full mt-2"></div>
                                    <div class="w-1 h-16 bg-blue-200 dark:bg-blue-800"></div>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white">{{ $event['title'] ?? '' }}</h3>
                                    @if(isset($event['date']))
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event['date'] }}</p>
                                    @endif
                                    @if(isset($event['description']))
                                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $event['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @break

        @case('embedded_video')
            <div>
                @if($section->title)
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $section->title }}</h2>
                @endif
                @if($section->metadata && isset($section->metadata['video_url']))
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden shadow-lg">
                        <iframe class="w-full h-full" src="{{ $section->metadata['video_url'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="bg-gray-100 dark:bg-gray-800 rounded-xl aspect-video flex items-center justify-center">
                        <span class="text-gray-500">Video content goes here</span>
                    </div>
                @endif
            </div>
            @break

        @case('notebook_step')
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border-l-4 border-blue-600">
                @if($section->title)
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">📓 {{ $section->title }}</h3>
                @endif
                <div class="text-gray-700 dark:text-gray-300">
                    {!! nl2br(e($section->content)) !!}
                </div>
                @if($section->image)
                    <img src="{{ Storage::url($section->image) }}" alt="{{ $section->title }}" class="mt-4 rounded-lg">
                @endif
            </div>
            @break

        @default
            <div class="text-gray-500 dark:text-gray-400">
                Unknown section type: {{ $section->section_type }}
            </div>
    @endswitch
</div>
