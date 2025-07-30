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

    <!-- Notification Container -->
    <div id="notification" class="fixed top-4 right-4 z-50 hidden max-w-sm">
        <div class="bg-white dark:bg-gray-800 border-l-4 border-red-500 p-4 shadow-lg rounded-lg">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-gray-700 dark:text-gray-300" id="notification-message"></p>
                </div>
                <div class="ml-auto pl-3">
                    <button onclick="hideNotification()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

<main class="max-w-6xl mx-auto px-4 pb-20">
        <div class="grid gap-8 lg:gap-12" id="blogPosts">
            <!-- Blog posts will be inserted here by JavaScript -->
        </div>
    </main>

     <script>
        // Variables
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

        if (darkModeToggle) darkModeToggle.addEventListener('click', toggleDarkMode);
        if (darkModeToggleMobile) darkModeToggleMobile.addEventListener('click', toggleDarkMode);

        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }

        // API Functions
        async function loadPosts() {
            try {
                const response = await fetch('/api/posts', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    blogPosts = data.map(post => ({
                        ...post
                        // Don't override any data as it all comes from the backend now
                    }));
                    renderBlogPosts();
                } else {
                    console.error('Failed to load posts. Status:', response.status);
                    showError('Failed to load posts. Please try again.');
                }
            } catch (error) {
                console.error('Error loading posts:', error);
                showError('Unable to connect to the server. Please check your connection.');
            }
        }

        // Show error message
        function showError(message) {
            const container = document.getElementById('blogPosts');
            container.innerHTML = `
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-red-400 dark:text-red-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xl text-red-500 dark:text-red-400">${message}</p>
                    <button onclick="loadPosts()" class="mt-4 px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Try Again
                    </button>
                </div>
            `;
        }

        // Show notification
        function showNotification(message, type = 'error') {
            const notification = document.getElementById('notification');
            const messageElement = document.getElementById('notification-message');
            const container = notification.querySelector('div');

            messageElement.textContent = message;

            // Update colors based on type
            container.className = `bg-white dark:bg-gray-800 border-l-4 p-4 shadow-lg rounded-lg ${
                type === 'success' ? 'border-green-500' : 'border-red-500'
            }`;

            notification.classList.remove('hidden');

            // Auto-hide after 5 seconds
            setTimeout(hideNotification, 5000);
        }

        // Hide notification
        function hideNotification() {
            document.getElementById('notification').classList.add('hidden');
        }

        // Test authentication function
        async function testAuth() {
            try {
                const response = await fetch('/api/auth-test', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Auth test result:', data);
                    showNotification(`Auth Status: ${data.authenticated ? 'Logged in as ' + data.user.name : 'Not logged in'}`, data.authenticated ? 'success' : 'error');
                } else {
                    console.error('Auth test failed. Status:', response.status);
                    showNotification('Auth test failed', 'error');
                }
            } catch (error) {
                console.error('Error testing auth:', error);
                showNotification('Auth test error', 'error');
            }
        }

        // Like functionality
        async function toggleLike(postId) {
            console.log('Attempting to toggle like for post:', postId);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            console.log('CSRF Token:', csrfToken ? 'Present' : 'Missing');

            try {
                const response = await fetch(`/api/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken || ''
                    }
                });

                console.log('Response status:', response.status);
                console.log('Response headers:', [...response.headers.entries()]);

                if (response.ok) {
                    const data = await response.json();
                    console.log('Like response data:', data);

                    // Update the post in our local data
                    const post = blogPosts.find(p => p.id === postId);
                    if (post) {
                        post.liked = data.liked;
                        post.likes = data.likes;
                        renderBlogPosts();
                        showNotification(`Post ${data.liked ? 'liked' : 'unliked'} successfully!`, 'success');
                    }
                } else if (response.status === 401) {
                    // User not authenticated
                    const errorData = await response.json().catch(() => ({}));
                    console.log('Auth error:', errorData);
                    showNotification('Authentication issue: ' + (errorData.debug || errorData.message || 'Please log in'), 'error');
                } else {
                    console.error('Failed to toggle like. Status:', response.status);
                    const errorData = await response.json().catch(() => ({ message: 'Unknown error' }));
                    console.log('Error data:', errorData);
                    showNotification('Failed to update like: ' + (errorData.message || 'Please try again.'), 'error');
                }
            } catch (error) {
                console.error('Error toggling like:', error);
                showNotification('Unable to connect to the server. Please check your connection.', 'error');
            }
        }

        // Comment functionality
        async function addComment(postId) {
            const commentInput = document.getElementById(`comment-${postId}`);
            const commentText = commentInput.value.trim();

            if (!commentText) return;

            console.log('Adding comment to post:', postId);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            try {
                const response = await fetch(`/api/posts/${postId}/comments`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },
                    body: JSON.stringify({
                        content: commentText
                    })
                });

                console.log('Comment response status:', response.status);

                if (response.ok) {
                    const data = await response.json();
                    console.log('Comment response data:', data);

                    // Update the post in our local data
                    const post = blogPosts.find(p => p.id === postId);
                    if (post) {
                        post.comments.push(data.comment); // Add to end (chronological order)
                        commentInput.value = '';
                        renderBlogPosts();
                        showNotification('Comment added successfully!', 'success');
                    }
                } else if (response.status === 401) {
                    const errorData = await response.json().catch(() => ({}));
                    console.log('Auth error:', errorData);
                    showNotification('Please log in to comment', 'error');
                } else {
                    console.error('Failed to add comment. Status:', response.status);
                    const errorData = await response.json().catch(() => ({ message: 'Unknown error' }));
                    console.log('Error data:', errorData);
                    showNotification('Failed to add comment: ' + (errorData.message || 'Please try again.'), 'error');
                }
            } catch (error) {
                console.error('Error adding comment:', error);
                showNotification('Unable to connect to the server. Please check your connection.', 'error');
            }
        }

        // Toggle comments visibility
        function toggleComments(postId) {
            const commentsSection = document.getElementById(`comments-${postId}`);
            commentsSection.classList.toggle('hidden');
        }

        // Render blog posts
        // Utility functions
        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString();
        }

        function calculateReadTime(content) {
            if (!content) return '5 min';
            const wordsPerMinute = 200;
            const words = content.split(' ').length;
            const minutes = Math.ceil(words / wordsPerMinute);
            return minutes + ' min';
        }

        // Render blog posts
        function renderBlogPosts() {
            const container = document.getElementById('blogPosts');

            if (blogPosts.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-xl text-gray-500 dark:text-gray-400">No posts available yet</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Check back later for new content!</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = '';

            blogPosts.forEach(post => {
                const postElement = document.createElement('article');
                postElement.className = 'card-hover rounded-2xl overflow-hidden transition-all duration-300 bg-white dark:bg-gray-800/50 border border-purple-200/50 dark:border-purple-500/20 hover:border-purple-300/60 dark:hover:border-purple-400/40 shadow-lg hover:shadow-2xl';

                postElement.innerHTML = `
                    <div class="md:flex">
                        <div class="md:w-1/3">
                            <img src="${post.image || 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&h=400&fit=crop'}" alt="${post.title}" class="w-full h-64 md:h-full object-cover">
                        </div>
                        <div class="md:w-2/3 p-8">
                            <div class="flex flex-wrap items-center gap-4 mb-4">
                                ${(post.tags || []).map(tag => `
                                    <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-sm rounded-full">
                                        ${tag.name}
                                    </span>
                                `).join('')}
                            </div>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-300">
                                    ${post.author_name || post.author || 'Unknown Author'}
                                </span>
                                <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>${formatDate(post.created_at || post.date)}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>${post.readTime || calculateReadTime(post.content) + ' read'}</span>
                                </div>
                            </div>

                            <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                                ${post.title}
                            </h3>

                            <p class="text-lg mb-6 leading-relaxed text-gray-600 dark:text-gray-300">
                                ${post.content ? post.content.substring(0, 200) + '...' : (post.excerpt || 'No description available.')}
                            </p>

                            <!-- Interaction Buttons -->
                            <div class="flex items-center space-x-6 mb-6">
                                <button onclick="toggleLike(${post.id})" class="like-btn flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 ${
                                    post.liked
                                        ? 'bg-red-500 text-white hover:bg-red-600'
                                        : 'bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-500/20 hover:text-red-500 dark:hover:text-red-400'
                                }">
                                    <svg class="w-5 h-5 ${post.liked ? 'fill-current' : ''}" fill="${post.liked ? 'currentColor' : 'none'}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span>${post.likes || 0}</span>
                                </button>

                                <button onclick="toggleComments(${post.id})" class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 bg-gray-100 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-500/20 hover:text-blue-500 dark:hover:text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span>${(post.comments || []).length}</span>
                                </button>
                            </div>

                            <!-- Comments Section -->
                            <div id="comments-${post.id}" class="hidden border-t border-gray-200 dark:border-gray-700 pt-6">
                                <div class="space-y-4 mb-6">
                                    ${(post.comments && post.comments.length > 0) ?
                                        post.comments.map(comment => `
                                            <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4 border-l-4 border-purple-200 dark:border-purple-500">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center space-x-2">
                                                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white text-sm font-bold">${comment.author.charAt(0).toUpperCase()}</span>
                                                        </div>
                                                        <span class="font-semibold text-purple-600 dark:text-purple-400">${comment.author}</span>
                                                    </div>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">${comment.time}</span>
                                                </div>
                                                <p class="text-gray-700 dark:text-gray-300 ml-10">${comment.content}</p>
                                            </div>
                                        `).join('')
                                        :
                                        `<div class="text-center py-8">
                                            <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            <p class="text-gray-500 dark:text-gray-400">No comments yet. Be the first to comment!</p>
                                        </div>`
                                    }
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
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent browser back button
            history.pushState(null, null, window.location.href);
            window.addEventListener('popstate', function(event) {
                history.pushState(null, null, window.location.href);
            });

            // Load posts from API
            loadPosts();
        });
    </script>

@endsection

