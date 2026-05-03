<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabs Navigation -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex gap-8" aria-label="Tabs">
                    <button type="button" onclick="showTab('home')" id="home-tab" class="tab-btn active py-2 px-1 border-b-2 border-indigo-500 font-medium text-sm text-indigo-600 hover:text-indigo-700 hover:border-indigo-400">
                        Home Page
                    </button>
                    <button type="button" onclick="showTab('about')" id="about-tab" class="tab-btn py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        About Page
                    </button>
                    <button type="button" onclick="showTab('projects')" id="projects-tab" class="tab-btn py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Projects
                    </button>
                    <button type="button" onclick="showTab('skills')" id="skills-tab" class="tab-btn py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Skills
                    </button>
                    <button type="button" onclick="showTab('technologies')" id="technologies-tab" class="tab-btn py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Technologies
                    </button>
                    <button type="button" onclick="showTab('education')" id="education-tab" class="tab-btn py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Education
                    </button>
                    <button type="button" onclick="showTab('contact')" id="contact-tab" class="tab-btn py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Contact
                    </button>
                </nav>
            </div>

            <!-- HOME PAGE TAB -->
            <div id="home" class="tab-content">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-6">Manage Home Page Content</h3>
                        
                        <form method="POST" action="{{ route('admin.pages.update', 'home.title') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Page Title</label>
                                <input type="text" name="value" value="{{ getContent('home.title') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter page title">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Title</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.pages.update', 'home.subtitle') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Page Subtitle</label>
                                <input type="text" name="value" value="{{ getContent('home.subtitle') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter page subtitle">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Subtitle</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.pages.update', 'home.description') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Page Description</label>
                                <textarea name="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter page description">{{ getContent('home.description') }}</textarea>
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Description</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ABOUT PAGE TAB -->
            <div id="about" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-6">Manage About Page Content</h3>
                        
                        <form method="POST" action="{{ route('admin.pages.update', 'about.title') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Page Title</label>
                                <input type="text" name="value" value="{{ getContent('about.title') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter page title">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Title</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.pages.update', 'about.intro') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Introduction</label>
                                <textarea name="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter introduction">{{ getContent('about.intro') }}</textarea>
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Introduction</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.pages.update', 'about.bio') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio Paragraph 1</label>
                                <textarea name="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter bio paragraph 1">{{ getContent('about.bio') }}</textarea>
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Bio 1</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.pages.update', 'about.bio2') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio Paragraph 2</label>
                                <textarea name="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter bio paragraph 2">{{ getContent('about.bio2') }}</textarea>
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Bio 2</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.pages.update', 'about.bio3') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio Paragraph 3</label>
                                <textarea name="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter bio paragraph 3">{{ getContent('about.bio3') }}</textarea>
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Bio 3</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- PROJECTS TAB -->
            <div id="projects" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Manage Projects</h3>
                            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                + Add Project
                            </a>
                        </div>

                        @if($projects = \App\Models\Project::all())
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($projects as $project)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $project->title }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $project->description }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    @if($project->link)
                                                        <a href="{{ $project->link }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">View</a>
                                                    @else
                                                        <span class="text-gray-400">-</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.projects.edit', $project) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No projects found. <a href="{{ route('admin.projects.create') }}" class="text-indigo-600 hover:text-indigo-900">Create one</a></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- SKILLS TAB -->
            <div id="skills" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Manage Skills</h3>
                            <a href="{{ route('admin.skills.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                + Add Skill
                            </a>
                        </div>

                        @if($skills = \App\Models\Skill::all())
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($skills as $skill)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $skill->name }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $skill->level }}%"></div>
                                                    </div>
                                                    <span class="text-xs">{{ $skill->level }}%</span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $skill->category }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No skills found. <a href="{{ route('admin.skills.create') }}" class="text-indigo-600 hover:text-indigo-900">Create one</a></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- TECHNOLOGIES TAB -->
            <div id="technologies" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Manage Technologies</h3>
                            <a href="{{ route('admin.technologies.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                + Add Technology
                            </a>
                        </div>

                        @if($technologies = \App\Models\Technology::all())
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($technologies as $technology)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $technology->name }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $technology->category }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    @if($technology->icon_class)
                                                        <i class="{{ $technology->icon_class }}"></i> {{ $technology->icon_class }}
                                                    @else
                                                        <span class="text-gray-400">-</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.technologies.edit', $technology) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No technologies found. <a href="{{ route('admin.technologies.create') }}" class="text-indigo-600 hover:text-indigo-900">Create one</a></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- EDUCATION TAB -->
            <div id="education" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Manage Education</h3>
                            <a href="{{ route('admin.education.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                + Add Education
                            </a>
                        </div>

                        @if($education = \App\Models\Education::orderBy('year_from', 'desc')->get())
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Institution</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Degree</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Years</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($education as $edu)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $edu->institution }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $edu->degree }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $edu->year_from }} - {{ $edu->year_to ?? 'Present' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.education.edit', $edu) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                                    <form action="{{ route('admin.education.destroy', $edu) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No education entries found. <a href="{{ route('admin.education.create') }}" class="text-indigo-600 hover:text-indigo-900">Create one</a></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- CONTACT TAB -->
            <div id="contact" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-6">Manage Contact Information</h3>

                        <form method="POST" action="{{ route('admin.contact.update', 'contact.intro') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Introduction Text</label>
                                <textarea name="value" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter introduction text">{{ getContactInfo('contact.intro') }}</textarea>
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Introduction</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.contact.update', 'contact.email') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="value" value="{{ getContactInfo('contact.email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter email address">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Email</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.contact.update', 'contact.phone') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="value" value="{{ getContactInfo('contact.phone') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter phone number">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Phone</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.contact.update', 'contact.location') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <input type="text" name="value" value="{{ getContactInfo('contact.location') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter location">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Location</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.contact.update', 'contact.get_in_touch') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">"Get in Touch" Section Title</label>
                                <input type="text" name="value" value="{{ getContactInfo('contact.get_in_touch') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter section title">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Section Title</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('admin.contact.update', 'contact.connect_online') }}" class="space-y-6 mt-6 pt-6 border-t">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">"Connect Online" Section Title</label>
                                <input type="text" name="value" value="{{ getContactInfo('contact.connect_online') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter section title">
                                <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Section Title</button>
                            </div>
                        </form>

                        <div class="mt-6 pt-6 border-t">
                            <h4 class="text-md font-semibold mb-4">Social Media Links</h4>

                            <form method="POST" action="{{ route('admin.contact.update', 'contact.github_url') }}" class="space-y-6">
                                @csrf
                                @method('PATCH')
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">GitHub URL</label>
                                    <input type="url" name="value" value="{{ getContactInfo('contact.github_url') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="https://github.com/username">
                                    <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update GitHub</button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('admin.contact.update', 'contact.linkedin_url') }}" class="space-y-6 mt-6">
                                @csrf
                                @method('PATCH')
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                                    <input type="url" name="value" value="{{ getContactInfo('contact.linkedin_url') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="https://linkedin.com/in/username">
                                    <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update LinkedIn</button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('admin.contact.update', 'contact.twitter_url') }}" class="space-y-6 mt-6">
                                @csrf
                                @method('PATCH')
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                                    <input type="url" name="value" value="{{ getContactInfo('contact.twitter_url') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="https://twitter.com/username">
                                    <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update Twitter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            // Remove active state from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Show selected tab
            document.getElementById(tabName).classList.remove('hidden');
            
            // Add active state to clicked button
            document.getElementById(tabName + '-tab').classList.add('border-indigo-500', 'text-indigo-600');
            document.getElementById(tabName + '-tab').classList.remove('border-transparent', 'text-gray-500');
        }
    </script>
</x-app-layout>
