<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Skill') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                            <input type="text" name="name" value="{{ old('name', $skill->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter skill name" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skill Level (0-100)</label>
                            <input type="number" name="level" value="{{ old('level', $skill->level) }}" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('level')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="Technical" {{ old('category', $skill->category) == 'Technical' ? 'selected' : '' }}>Technical</option>
                                <option value="Backend Development" {{ old('category', $skill->category) == 'Backend Development' ? 'selected' : '' }}>Backend Development</option>
                                <option value="Frontend Development" {{ old('category', $skill->category) == 'Frontend Development' ? 'selected' : '' }}>Frontend Development</option>
                                <option value="DevOps" {{ old('category', $skill->category) == 'DevOps' ? 'selected' : '' }}>DevOps</option>
                                <option value="Cybersecurity" {{ old('category', $skill->category) == 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                                <option value="Soft Skills" {{ old('category', $skill->category) == 'Soft Skills' ? 'selected' : '' }}>Soft Skills</option>
                            </select>
                            @error('category')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Update Skill
                            </button>
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
