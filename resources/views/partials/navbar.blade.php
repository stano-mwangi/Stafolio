<nav class="flex justify-between items-center p-6 text-gray-800 bg-white shadow-md">
     <a href="/" class="text-2xl font-bold">Stanley</a>
    <div class="flex space-x-8">
        <a href="/" class="font-semibold">Home</a>
        <a href="{{ route('projects') }}">Projects</a>
       <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
        @auth
            <a href="{{ route('dashboard') }}">Profile</a>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
</nav>
