<nav class="flex justify-between items-center p-6 text-white">
    <div class="flex space-x-8">
        <a href="/" class="font-semibold">Home</a>
        <a href="{{ route('projects.index') }}">Projects</a>
       <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
        @auth
            <a href="{{ route('dashboard') }}">Profile</a>
        @else
            <a href="{{ route('login') }}">Stanley</a>
        @endauth
    </div>
</nav>
