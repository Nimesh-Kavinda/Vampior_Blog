<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vampior Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .dark .gradient-text {
            background: linear-gradient(135deg, #a78bfa 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
        }
        .like-btn {
            transition: all 0.3s ease;
        }
        .like-btn.liked {
            color: #ef4444;
            fill: #ef4444;
        }
    </style>
</head>
<body class="min-h-screen transition-colors duration-300 bg-gradient-to-br from-white via-purple-50 to-pink-50 text-gray-900 dark:from-gray-900 dark:via-purple-900 dark:to-black dark:text-white">

    <!-- Navigation -->
      <nav class="sticky top-0 z-50 backdrop-blur-md bg-white/80 dark:bg-gray-900/80 border-b border-purple-200/50 dark:border-purple-500/20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold gradient-text">Vampior Blog</h1>
                    <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 rounded-full text-sm font-medium">Role</span>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    <button id="darkModeToggle" class="p-2 rounded-lg transition-all duration-300 bg-purple-100 hover:bg-purple-200 text-purple-600 dark:bg-purple-800/50 dark:hover:bg-purple-700/50 dark:text-yellow-400">
                        <svg id="sunIcon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="moonIcon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                      <span onclick="window.location.href='#'" class="px-4 py-2 rounded-lg font-medium transition-all duration-300 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                        Name
                    </span>

                    <a href="{{ route('login') }}">
                        <button class="px-6 py-2 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                        Login
                    </button>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                        Logout
                    </button>
                    </form>


                </div>

                <div class="md:hidden">
                    <button id="mobileMenuToggle" class="p-2 rounded-lg text-purple-600 dark:text-purple-400">
                        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden border-t bg-white/95 dark:bg-gray-900/95 border-purple-200/50 dark:border-purple-500/20">
            <div class="px-4 py-4 space-y-4">
                <button id="darkModeToggleMobile" class="flex items-center space-x-2 w-full p-2 rounded-lg transition-all duration-300 bg-purple-100 hover:bg-purple-200 text-purple-600 dark:bg-purple-800/50 dark:hover:bg-purple-700/50 dark:text-yellow-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                    <span>Toggle Theme</span>
                </button>

                <span class="flex items-center space-x-2 w-full px-4 py-2 rounded-lg font-medium transition-all duration-300 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <span>Name</span>
                </span>

                <button class="flex items-center space-x-2 w-full px-4 py-2 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                    <span>Login</span>
                </button>

            </div>
        </div>
    </nav>

    @yield('content')

      <footer class="border-t border-purple-200/50 dark:border-purple-500/20 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold gradient-text mb-4">Vampior Blog</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    Crafting stories that inspire and inform
                </p>
                <div class="flex justify-center space-x-6 text-sm text-gray-500 dark:text-gray-400">
                    <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Terms</a>
                    <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Contact</a>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-4">
                    © 2024 Vampior Blog. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
