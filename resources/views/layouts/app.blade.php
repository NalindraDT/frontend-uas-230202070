<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-950 text-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-950">
        <!-- Sidebar Overlay -->
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <span class="mx-2 text-2xl font-semibold text-white">Admin Panel</span>
            </div>

            <nav class="mt-10">
                <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('dashboard') ? 'text-white bg-gray-700' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}"
                    href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('mahasiswa.*') ? 'text-white bg-gray-700' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}"
                    href="{{ route('mahasiswa.index') }}">
                    <i class="fas fa-user-tie mr-3"></i> Mahasiswa
                </a>
                <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('matkul.*') ? 'text-white bg-gray-700' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}"
                    href="{{ route('matkul.index') }}">
                    <i class="fas fa-user-graduate mr-3"></i> Matkul
                </a>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-gray-800 border-b border-gray-700">
                <button @click="sidebarOpen = true" class="text-gray-300 focus:outline-none lg:hidden">
                    <i class="fas fa-bars text-lg"></i>
                </button>

                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = ! dropdownOpen"
                        class="block h-8 w-8 rounded-full overflow-hidden focus:outline-none">
                        <i class="fas fa-user-circle text-2xl text-gray-300"></i>
                    </button>

                    <div x-show="dropdownOpen" @click="dropdownOpen = false"
                        class="fixed inset-0 h-full w-full z-10"></div>

                    <div x-show="dropdownOpen"
                        class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg z-20"
                        x-cloak>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-indigo-600 hover:text-white">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-indigo-600 hover:text-white">Logout</a>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-950">
                <div class="container mx-auto px-6 py-8">
                    @if(session('success'))
                    <div class="bg-green-800 text-green-100 border border-green-600 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-800 text-red-100 border border-red-600 px-4 py-3 rounded mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>