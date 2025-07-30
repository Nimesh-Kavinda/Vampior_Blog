@extends('layouts.app')

@section('content')

<header class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 dark:from-purple-400 dark:via-pink-400 dark:to-red-400 bg-clip-text text-transparent">
                        Editor Dashboard
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300">
                        Create, edit, and manage your blog posts
                    </p>
                </div>
                <button id="createNewPost" class="mt-6 md:mt-0 px-8 py-3 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create New Post
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 pb-20">
        <!-- Editor Form (Hidden by default) -->
        <div id="editorForm" class="hidden mb-12">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-purple-200/50 dark:border-purple-500/20 p-8 shadow-lg">
                <h3 id="editorTitle" class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Create New Post</h3>

                <form id="postForm" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" id="postTitle" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="Enter post title...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Author</label>
                            <input type="text" id="postAuthor" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="Author name...">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Image URL</label>
                            <input type="url" id="postImage" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="https://example.com/image.jpg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Read Time</label>
                            <input type="text" id="postReadTime" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="5 min read">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Status</label>
                            <select id="postStatus" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Tags</label>
                        <input type="text" id="postTags" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="Enter tags separated by commas (e.g., technology, web development, coding)">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Separate multiple tags with commas</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Excerpt</label>
                        <textarea id="postExcerpt" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" rows="3" placeholder="Brief description of the post..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Content</label>
                        <textarea id="postContent" class="editor-textarea w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="Write your blog post content here..."></textarea>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="px-8 py-3 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Post
                        </button>
                        <button type="button" id="cancelEdit" class="px-8 py-3 rounded-lg font-medium transition-all duration-300 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Posts List -->
        <div id="postsList">
            <h3 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white">Your Blog Posts</h3>
            <div id="postsContainer" class="grid gap-6">
                <!-- Posts will be rendered here -->
            </div>
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-md w-full">
            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Delete Post</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Are you sure you want to delete this post? This action cannot be undone.</p>
            <div class="flex space-x-4">
                <button id="confirmDelete" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all duration-300">
                    Delete
                </button>
                <button id="cancelDelete" class="px-6 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium transition-all duration-300">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        // Variables
        let blogPosts = [];
        let editingPostId = null;
        let postToDelete = null;

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

        // Editor functionality
        const editorForm = document.getElementById('editorForm');
        const postsList = document.getElementById('postsList');
        const createNewPostBtn = document.getElementById('createNewPost');
        const cancelEditBtn = document.getElementById('cancelEdit');
        const postForm = document.getElementById('postForm');
        const editorTitle = document.getElementById('editorTitle');

        // API Functions
        async function loadPosts() {
            try {
                const response = await fetch('/editor/posts', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    blogPosts = data.posts;
                    renderPosts();
                } else {
                    showNotification('Failed to load posts: ' + data.message, 'error');
                }
            } catch (error) {
                console.error('Error loading posts:', error);
                showNotification('Failed to load posts', 'error');
            }
        }

        async function savePost(postData) {
            try {
                const url = editingPostId ? `/editor/posts/${editingPostId}` : '/editor/posts';
                const method = editingPostId ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(postData)
                });

                const data = await response.json();

                if (data.success) {
                    showNotification(data.message, 'success');
                    hideEditor();
                    loadPosts(); // Reload posts from server
                } else {
                    showNotification(data.message, 'error');
                }
            } catch (error) {
                console.error('Error saving post:', error);
                showNotification('Failed to save post', 'error');
            }
        }

        async function deletePost(postId) {
            try {
                const response = await fetch(`/editor/posts/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showNotification(data.message, 'success');
                    loadPosts(); // Reload posts from server
                } else {
                    showNotification(data.message, 'error');
                }
            } catch (error) {
                console.error('Error deleting post:', error);
                showNotification('Failed to delete post', 'error');
            }
        }

        // UI Functions
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        createNewPostBtn.addEventListener('click', () => {
            showEditor();
        });

        cancelEditBtn.addEventListener('click', () => {
            hideEditor();
        });

        function showEditor(post = null) {
            editingPostId = post ? post.id : null;
            editorTitle.textContent = post ? 'Edit Post' : 'Create New Post';

            if (post) {
                document.getElementById('postTitle').value = post.title;
                document.getElementById('postAuthor').value = post.author;
                document.getElementById('postImage').value = post.image;
                document.getElementById('postReadTime').value = post.read_time || post.readTime || '';
                document.getElementById('postExcerpt').value = post.excerpt;
                document.getElementById('postContent').value = post.content;
                document.getElementById('postStatus').value = post.status;

                // Handle tags
                const tagNames = post.tags ? post.tags.map(tag => tag.name).join(', ') : '';
                document.getElementById('postTags').value = tagNames;
            } else {
                postForm.reset();
            }

            editorForm.classList.remove('hidden');
            postsList.classList.add('hidden');
            editorForm.scrollIntoView({ behavior: 'smooth' });
        }

        function hideEditor() {
            editorForm.classList.add('hidden');
            postsList.classList.remove('hidden');
            editingPostId = null;
            postForm.reset();
        }

        // Form submission
        postForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                title: document.getElementById('postTitle').value,
                author: document.getElementById('postAuthor').value,
                image: document.getElementById('postImage').value,
                read_time: document.getElementById('postReadTime').value,
                excerpt: document.getElementById('postExcerpt').value,
                content: document.getElementById('postContent').value,
                status: document.getElementById('postStatus').value,
                tags: document.getElementById('postTags').value
            };

            // Basic validation
            if (!formData.title || !formData.excerpt || !formData.content || !formData.author) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }

            await savePost(formData);
        });

        // Delete functionality
        const deleteModal = document.getElementById('deleteModal');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');

        function showDeleteModal(postId) {
            postToDelete = postId;
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        }

        function hideDeleteModal() {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            postToDelete = null;
        }

        confirmDelete.addEventListener('click', async () => {
            if (postToDelete) {
                await deletePost(postToDelete);
                hideDeleteModal();
            }
        });

        cancelDelete.addEventListener('click', hideDeleteModal);

        // Close modal when clicking outside
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                hideDeleteModal();
            }
        });

        // Render posts
        function renderPosts() {
            const container = document.getElementById('postsContainer');
            container.innerHTML = '';

            if (blogPosts.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-xl text-gray-500 dark:text-gray-400">No blog posts yet</p>
                        <p class="text-gray-400 dark:text-gray-500 mt-2">Create your first post to get started</p>
                    </div>
                `;
                return;
            }

            blogPosts.forEach(post => {
                const postElement = document.createElement('div');
                postElement.className = 'card-hover bg-white dark:bg-gray-800/50 rounded-2xl border border-purple-200/50 dark:border-purple-500/20 p-6 shadow-lg';

                // Format the post data to match the expected format
                const formattedPost = {
                    id: post.id,
                    title: post.title,
                    excerpt: post.excerpt,
                    content: post.content,
                    author: post.author,
                    image: post.image,
                    read_time: post.read_time,
                    status: post.status,
                    tags: post.tags || []
                };

                // Generate tags HTML
                const tagsHtml = post.tags && post.tags.length > 0
                    ? post.tags.map(tag => `<span class="inline-block px-2 py-1 text-xs rounded-full text-white mr-1 mb-1" style="background-color: ${tag.color}">${tag.name}</span>`).join('')
                    : '';

                postElement.innerHTML = `
                    <div class="flex flex-col lg:flex-row gap-6">
                        <div class="lg:w-1/4">
                            <img src="${post.image}" alt="${post.title}" class="w-full h-48 lg:h-32 object-cover rounded-lg">
                        </div>
                        <div class="lg:w-2/4">
                            <div class="flex items-center space-x-2 mb-2">
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white">${post.title}</h4>
                                <span class="px-2 py-1 text-xs rounded-full ${post.status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400'}">${post.status}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-3">${post.excerpt}</p>
                            ${tagsHtml ? `<div class="mb-3">${tagsHtml}</div>` : ''}
                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>${post.author}</span>
                                <span>•</span>
                                <span>${new Date(post.created_at).toLocaleDateString()}</span>
                                <span>•</span>
                                <span>${post.read_time}</span>
                                <span>•</span>
                                <span>${post.likes} likes</span>
                            </div>
                        </div>
                        <div class="lg:w-1/4 flex lg:flex-col gap-3">
                            <button onclick="showEditor(${JSON.stringify(formattedPost).replace(/"/g, '&quot;')})" class="flex-1 lg:flex-none px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition-all duration-300 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button onclick="showDeleteModal(${post.id})" class="flex-1 lg:flex-none px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all duration-300 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                `;

                container.appendChild(postElement);
            });
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent browser back button
            history.pushState(null, null, window.location.href);
            window.addEventListener('popstate', function(event) {
                history.pushState(null, null, window.location.href);
            });

            // Load posts from server
            loadPosts();
        });
    </script>

@endsection
