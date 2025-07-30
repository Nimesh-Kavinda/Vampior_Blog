@extends('layouts.app')

@section('content')

    <style>
         .comment-hover {
            transition: all 0.2s ease;
        }
        .comment-hover:hover {
            background-color: rgba(139, 92, 246, 0.05);
        }
        .dark .comment-hover:hover {
            background-color: rgba(139, 92, 246, 0.1);
        }
        .prose {
            max-width: none;
        }
        .prose p {
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }
        .prose h2 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .prose h3 {
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
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

   <main class="max-w-4xl mx-auto px-4 py-12">
        <!-- Blog Post Header -->
        <article class="bg-white dark:bg-gray-800/50 rounded-2xl border border-purple-200/50 dark:border-purple-500/20 shadow-lg overflow-hidden">
            <!-- Featured Image -->
            <div class="w-full h-64 sm:h-80 md:h-96 lg:h-[28rem] overflow-hidden">
                <img id="postImage" src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>

            <!-- Post Content -->
            <div class="p-8 md:p-12">
                <!-- Post Meta -->
                <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm" id="authorInitial">{{ substr($post->author, 0, 1) }}</span>
                        </div>
                        <span id="postAuthor" class="font-medium">{{ $post->author }}</span>
                    </div>
                    <span>•</span>
                    <span id="postDate">{{ $post->created_at->format('F j, Y') }}</span>
                    <span>•</span>
                    <span id="postReadTime">{{ $post->read_time }}</span>
                    <span>•</span>
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        <span id="viewCount">{{ rand(100, 5000) }} views</span>
                    </div>
                </div>

                <!-- Post Title -->
                <h1 id="postTitle" class="text-3xl md:text-4xl font-bold mb-6 bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 dark:from-purple-400 dark:via-pink-400 dark:to-red-400 bg-clip-text text-transparent">
                    {{ $post->title }}
                </h1>

                <!-- Tags -->
                @if($post->tags && $post->tags->count() > 0)
                    <div class="mb-6">
                        @foreach($post->tags as $tag)
                            <span class="inline-block px-3 py-1 text-sm rounded-full text-white mr-2 mb-2" style="background-color: {{ $tag->color }}">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Post Excerpt -->
                <p id="postExcerpt" class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                    {{ $post->excerpt }}
                </p>

                <!-- Post Content -->
                <div id="postContent" class="prose prose-lg max-w-none text-gray-800 dark:text-gray-200">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-6">
                        <button id="likeBtn" onclick="redirectToLogin()" class="like-btn flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-red-900/20 text-gray-600 dark:text-gray-300 hover:text-red-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="likeCount">{{ $post->likes }}</span>
                            <span>Likes</span>
                        </button>

                        <button onclick="redirectToLogin()" class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700 hover:bg-purple-50 dark:hover:bg-purple-900/20 text-gray-600 dark:text-gray-300 hover:text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span id="commentCount">0</span>
                            <span>Comments</span>
                        </button>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button onclick="sharePost()" class="p-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-gray-600 dark:text-gray-300 hover:text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                        </button>
                        <button onclick="bookmarkPost()" class="p-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 text-gray-600 dark:text-gray-300 hover:text-yellow-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </button>
                        <a href="/" class="p-2 rounded-lg transition-all duration-300 bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-800/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Comments Section - Login Required -->
        <section class="mt-12">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-purple-200/50 dark:border-purple-500/20 shadow-lg p-8 text-center">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Join the Conversation</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-6">Login to like posts, leave comments, and interact with the community.</p>
                <a href="/login" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login to Continue
                </a>
            </div>
        </section>

    </main>

    <script>
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

        // Guest redirection functions
        function redirectToLogin() {
            window.location.href = '/login';
        }

        // Share functionality
        function sharePost() {
            if (navigator.share) {
                navigator.share({
                    title: document.getElementById('postTitle').textContent,
                    text: document.getElementById('postExcerpt').textContent,
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link copied to clipboard!');
                });
            }
        }

        // Bookmark functionality
        function bookmarkPost() {
            // Redirect to login for guests
            window.location.href = '/login';
        }
    </script>


@endsection
