@extends('layouts.app')

@section('content')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .dark .card-hover:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
    }
</style>

    <header class="py-20 px-4 text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 dark:from-purple-400 dark:via-pink-400 dark:to-red-400 bg-clip-text text-transparent">
                Welcome to Vampior
            </h2>
            <p class="text-xl md:text-2xl mb-8 text-gray-600 dark:text-gray-300">
                Discover stories, insights, and ideas that matter
            </p>
            <div class="w-24 h-1 mx-auto rounded-full bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400"></div>
        </div>
    </header>

<main class="max-w-6xl mx-auto px-4 pb-20">
        <div class="grid gap-8 lg:gap-12" id="blogPosts">
            <!-- Blog posts will be inserted here by JavaScript -->
        </div>
    </main>

     <script>
        // Blog posts data - will be loaded from database
        let blogPosts = [];

        // Dark mode functionality
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeToggleMobile = document.getElementById('darkModeToggleMobile');
        const html = document.documentElement;

        function toggleDarkMode() {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        }

        // Initialize dark mode from localStorage
        if (localStorage.getItem('darkMode') === 'true') {
            html.classList.add('dark');
        }

        darkModeToggle.addEventListener('click', toggleDarkMode);
        darkModeToggleMobile.addEventListener('click', toggleDarkMode);

        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Like functionality - redirect to login for guests
        function toggleLike(postId) {
            window.location.href = '/login';
        }

        // Comment functionality - redirect to login for guests
        function addComment(postId) {
            window.location.href = '/login';
        }

        // Toggle comments visibility - redirect to login for guests
        function toggleComments(postId) {
            window.location.href = '/login';
        }

        // Fetch posts from database
        async function loadPosts() {
            try {
                const response = await fetch('/api/posts');
                const posts = await response.json();
                blogPosts = posts;
                renderBlogPosts();
            } catch (error) {
                console.error('Error loading posts:', error);
                // Keep static posts as fallback
                renderBlogPosts();
            }
        }

        // Render blog posts
        function renderBlogPosts() {
            const container = document.getElementById('blogPosts');
            container.innerHTML = '';

            blogPosts.forEach(post => {
                const postElement = document.createElement('article');
                postElement.className = 'card-hover rounded-2xl overflow-hidden transition-all duration-300 bg-white dark:bg-gray-800/50 border border-purple-200/50 dark:border-purple-500/20 hover:border-purple-300/60 dark:hover:border-purple-400/40 shadow-lg hover:shadow-2xl';

                postElement.innerHTML = `
                    <div class="md:flex">
                        <div class="md:w-2/5 lg:w-1/3">
                            <a href="/post/${post.id}" class="block">
                                <img src="${post.image}" alt="${post.title}" class="w-full h-48 md:h-56 lg:h-64 object-cover hover:opacity-90 transition-opacity cursor-pointer rounded-l-xl md:rounded-l-2xl md:rounded-r-none">
                            </a>
                        </div>
                        <div class="md:w-3/5 lg:w-2/3 p-6 md:p-8">
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-300">
                                    ${post.author}
                                </span>
                                <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>${new Date(post.date).toLocaleDateString()}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>${post.readTime}</span>
                                </div>
                            </div>

                            <h3 class="text-xl md:text-2xl lg:text-3xl font-bold mb-3 md:mb-4 text-gray-900 dark:text-white line-clamp-2">
                                <a href="/post/${post.id}" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">
                                    ${post.title}
                                </a>
                            </h3>

                            <p class="text-base md:text-lg mb-4 md:mb-6 leading-relaxed text-gray-600 dark:text-gray-300 line-clamp-3">
                                ${post.excerpt}
                            </p>

                            <!-- Interaction Buttons -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <button onclick="toggleLike(${post.id})" class="like-btn flex items-center space-x-2 px-3 py-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-500/20 hover:text-red-500 dark:hover:text-red-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        <span class="text-sm">${post.likes}</span>
                                    </button>

                                    <button onclick="toggleComments(${post.id})" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-500/20 hover:text-blue-500 dark:hover:text-blue-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="text-sm">${post.comments ? post.comments.length : 0}</span>
                                    </button>
                                </div>

                                <a href="/post/${post.id}" class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-800/50 font-medium">
                                    <span class="text-sm">Read More</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(postElement);
            });
        }

        // Initialize the blog
        document.addEventListener('DOMContentLoaded', function() {
            loadPosts();
        });
    </script>

@endsection
