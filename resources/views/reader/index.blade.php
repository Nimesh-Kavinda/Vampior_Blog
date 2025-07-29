@extends('layouts.app')

@section('content')

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
        // Blog posts data
        const blogPosts = [
            {
                id: 1,
                title: "The Art of Modern Web Development",
                excerpt: "Exploring the latest trends and techniques in contemporary web development, from React to advanced CSS animations.",
                author: "Alex Morgan",
                date: "2024-07-25",
                readTime: "5 min read",
                image: "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&h=400&fit=crop",
                likes: 42,
                comments: [
                    { id: 1, author: "Sarah Chen", content: "Great insights! Really helpful for understanding modern frameworks.", time: "2 hours ago" },
                    { id: 2, author: "Mike Johnson", content: "This changed my perspective on responsive design.", time: "5 hours ago" }
                ],
                liked: false
            },
            {
                id: 2,
                title: "Mastering Dark Mode Design",
                excerpt: "A comprehensive guide to creating beautiful and accessible dark mode interfaces that users will love.",
                author: "Emma Rodriguez",
                date: "2024-07-22",
                readTime: "8 min read",
                image: "https://images.unsplash.com/photo-1558655146-d09347e92766?w=800&h=400&fit=crop",
                likes: 67,
                comments: [
                    { id: 1, author: "David Kim", content: "Perfect timing! I'm implementing dark mode in my app right now.", time: "1 day ago" }
                ],
                liked: false
            },
            {
                id: 3,
                title: "The Future of AI in Creative Industries",
                excerpt: "How artificial intelligence is reshaping creativity and what it means for designers, writers, and artists.",
                author: "Jordan Blake",
                date: "2024-07-20",
                readTime: "12 min read",
                image: "https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=400&fit=crop",
                likes: 89,
                comments: [
                    { id: 1, author: "Lisa Park", content: "Fascinating perspective on AI's role in creativity!", time: "2 days ago" },
                    { id: 2, author: "Tom Wilson", content: "I'm excited to see where this technology takes us.", time: "2 days ago" },
                    { id: 3, author: "Ana Garcia", content: "Great balance between optimism and realistic concerns.", time: "3 days ago" }
                ],
                liked: false
            }
        ];

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

        // Like functionality
        function toggleLike(postId) {
            const post = blogPosts.find(p => p.id === postId);
            post.liked = !post.liked;
            post.likes += post.liked ? 1 : -1;
            renderBlogPosts();
        }

        // Comment functionality
        function addComment(postId) {
            const commentInput = document.getElementById(`comment-${postId}`);
            const commentText = commentInput.value.trim();

            if (!commentText) return;

            const post = blogPosts.find(p => p.id === postId);
            post.comments.push({
                id: post.comments.length + 1,
                author: "You",
                content: commentText,
                time: "Just now"
            });

            commentInput.value = '';
            renderBlogPosts();
        }

        // Toggle comments visibility
        function toggleComments(postId) {
            const commentsSection = document.getElementById(`comments-${postId}`);
            commentsSection.classList.toggle('hidden');
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
                        <div class="md:w-1/3">
                            <img src="${post.image}" alt="${post.title}" class="w-full h-64 md:h-full object-cover">
                        </div>
                        <div class="md:w-2/3 p-8">
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

                            <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                                ${post.title}
                            </h3>

                            <p class="text-lg mb-6 leading-relaxed text-gray-600 dark:text-gray-300">
                                ${post.excerpt}
                            </p>

                            <!-- Interaction Buttons -->
                            <div class="flex items-center space-x-6 mb-6">
                                <button onclick="toggleLike(${post.id})" class="like-btn flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 ${
                                    post.liked
                                        ? 'bg-red-500 text-white'
                                        : 'bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-500/20 hover:text-red-500 dark:hover:text-red-400'
                                }">
                                    <svg class="w-5 h-5 ${post.liked ? 'fill-current' : ''}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span>${post.likes}</span>
                                </button>

                                <button onclick="toggleComments(${post.id})" class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-500/20 hover:text-blue-500 dark:hover:text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span>${post.comments.length}</span>
                                </button>
                            </div>

                            <!-- Comments Section -->
                            <div id="comments-${post.id}" class="hidden border-t border-gray-200 dark:border-gray-700 pt-6">
                                <div class="space-y-4 mb-6">
                                    ${post.comments.map(comment => `
                                        <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="font-semibold text-purple-600 dark:text-purple-400">${comment.author}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">${comment.time}</span>
                                            </div>
                                            <p class="text-gray-700 dark:text-gray-300">${comment.content}</p>
                                        </div>
                                    `).join('')}
                                </div>

                                <div class="flex space-x-3">
                                    <input
                                        type="text"
                                        id="comment-${post.id}"
                                        placeholder="Add a comment..."
                                        class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                        onkeypress="if(event.key==='Enter') addComment(${post.id})"
                                    >
                                    <button
                                        onclick="addComment(${post.id})"
                                        class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 font-medium"
                                    >
                                        Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(postElement);
            });
        }

        // Initialize the blog
        renderBlogPosts();
    </script>

@endsection
