<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'My Laravel App')</title>
        <!-- Include Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Include Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Include Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <style>
            @yield('style')
        </style>
    </head>
    <body class="h-screen w-full font-roboto">
        <div class="flex flex-col h-screen">
            <!-- Header Section -->
            <header class="bg-white shadow-md p-4 fixed top-0 w-full flex items-center justify-between z-50 h-[70px]">
                <div class="flex-shrink-0">
                    <img src="{{ asset('layouts/logo_astratech.png') }}" alt="ASTRAtech Logo" class="h-12">
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-black text-right">
                        <p class="m-0 font-bold">{{ session('full_name') }} ({{ session('rol_id') }})</p>
                        <small>{{ session('last_login_at') }}</small>
                    </div>
                    <button id="sidebarToggle" class="md:hidden p-2 bg-gray-200 rounded">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="relative">
                        <i class="fas fa-envelope text-2xl text-gray-700"></i>
                        <span class="absolute top-0 right-0 bg-blue-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </div>
                </div>
            </header>

            <div class="flex h-full pt-[70px]">
                <!-- Sidebar -->
                <nav id="sidebarMenu" class="bg-white w-64 fixed top-[70px] left-0 h-full p-4 transform -translate-x-full transition-transform md:translate-x-0 shadow-md">
                    <ul class="space-y-2">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 p-2 rounded text-left flex items-center">
                                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                </button>
                            </form>
                        </li>
                        <li>
                            <a href="{{ route('admin.show', ['beranda']) }}" class="block w-full p-2 rounded text-gray-700 flex items-center hover:bg-blue-100 {{ Request::get('page') === 'beranda' ? 'bg-blue-500 text-white' : '' }}">
                                <i class="fas fa-home mr-3"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <button class="w-full flex justify-between items-center p-2 bg-gray-100 hover:bg-gray-200 rounded" onclick="toggleDropdown('healthDropdown')">
                                <span>Master</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul id="healthDropdown" class="hidden opacity-0 transform transition-all duration-200 ease-in-out space-y-2 pl-4">
                                <li>
                                    <a href="http://127.0.0.1:8000/questionnaire/" class="block p-2 rounded hover:bg-gray-100">Kuisioner</a>
                                </li>
                            </ul>

                        </li>
                    </ul>
                </nav>

                <!-- Main Content -->
                <main class="flex-1 p-4 overflow-y-auto ml-0 md:ml-64">
                    @yield('content')
                </main>
            </div>
        </div>

        <script>
            document.getElementById('sidebarToggle').addEventListener('click', function () {
                document.getElementById('sidebarMenu').classList.toggle('-translate-x-full');
            });

            function toggleDropdown(id) {
                let dropdown = document.getElementById(id);

                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    dropdown.classList.add('opacity-0', 'translate-y-[-10px]');
                    
                    setTimeout(() => {
                        dropdown.classList.add('opacity-100', 'translate-y-0');
                        dropdown.classList.remove('opacity-0', 'translate-y-[-10px]');
                    }, 10);
                } else {
                    dropdown.classList.add('opacity-0', 'translate-y-[-10px]');
                    dropdown.classList.remove('opacity-100', 'translate-y-0');

                    setTimeout(() => {
                        dropdown.classList.add('hidden');
                    }, 200); // Matches the transition duration
                }
            }
        </script>
        @yield('scripts')
        
    </body>
</html>