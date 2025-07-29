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

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Image URL</label>
                            <input type="url" id="postImage" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="https://example.com/image.jpg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Read Time</label>
                            <input type="text" id="postReadTime" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="5 min read">
                        </div>
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
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
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
        // Sample blog posts data
        let blogPosts = [
            {
                id: 1,
                title: "The Art of Modern Web Development",
                excerpt: "Exploring the latest trends and techniques in contemporary web development, from React to advanced CSS animations.",
                content: "In today's rapidly evolving digital landscape, web development has transformed into an art form that combines technical precision with creative vision. Modern frameworks like React, Vue, and Angular have revolutionized how we build user interfaces, while CSS has evolved to include powerful features like Grid, Flexbox, and custom properties.\n\nThe rise of JAMstack architecture has also changed how we think about web performance and security. By pre-building pages and serving them from CDNs, we can achieve lightning-fast load times while maintaining dynamic functionality through APIs and serverless functions.\n\nAs we look to the future, emerging technologies like WebAssembly, Progressive Web Apps, and AI-powered development tools promise to further transform the landscape of web development.",
                author: "Alex Morgan",
                date: "2024-07-25",
                readTime: "5 min read",
                image: "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&h=400&fit=crop",
                likes: 42,
                comments: []
            },
            {
                id: 2,
                title: "Mastering Dark Mode Design",
                excerpt: "A comprehensive guide to creating beautiful and accessible dark mode interfaces that users will love.",
                content: "Dark mode has become more than just a trend—it's now an essential feature that users expect from modern applications. Implementing dark mode effectively requires careful consideration of color contrast, accessibility, and user experience.\n\nWhen designing for dark mode, it's crucial to avoid pure black backgrounds, which can cause eye strain and make text harder to read. Instead, use dark grays and subtle color variations to create depth and hierarchy. Consider how your brand colors translate to dark themes, and ensure that all interactive elements remain clearly visible and accessible.\n\nTesting across different devices and lighting conditions is essential, as what looks good on a desktop monitor may not work well on a mobile device in bright sunlight.",
                author: "Emma Rodriguez",
                date: "2024-07-22",
                readTime: "8 min read",
                image: "https://images.unsplash.com/photo-1558655146-d09347e92766?w=800&h=400&fit=crop",
                likes: 67,
                comments: []
            },
            {
                id: 3,
                title: "The Future of AI in Creative Industries",
                excerpt: "How artificial intelligence is reshaping creativity and what it means for designers, writers, and artists.",
                content: "Artificial intelligence is revolutionizing creative industries in ways we never imagined possible. From AI-generated art and music to automated design tools and writing assistants, technology is becoming an increasingly important collaborator in the creative process.\n\nFor designers, AI tools can automate repetitive tasks, generate initial concepts, and even suggest color palettes based on brand guidelines. Writers are using AI to overcome writer's block, generate ideas, and even help with research and fact-checking.\n\nHowever, this technological advancement also raises important questions about the nature of creativity, authorship, and the future role of human creators. Rather than replacing human creativity, the most successful applications of AI seem to augment and enhance human capabilities, allowing creators to focus on higher-level conceptual work while AI handles routine tasks.",
                author: "Jordan Blake",
                date: "2024-07-20",
                readTime: "12 min read",
                image: "https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=400&fit=crop",
                likes: 89,
                comments: []
            }
        ];

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

        // Editor functionality
        const editorForm = document.getElementById('editorForm');
        const postsList = document.getElementById('postsList');
        const createNewPostBtn = document.getElementById('createNewPost');
        const cancelEditBtn = document.getElementById('cancelEdit');
        const postForm = document.getElementById('postForm');
        const editorTitle = document.getElementById('editorTitle');

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
                document.getElementById('postReadTime').value = post.readTime;
                document.getElementById('postExcerpt').value = post.excerpt;
                document.getElementById('postContent').value = post.content;
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
        postForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = {
                title: document.getElementById('postTitle').value,
                author: document.getElementById('postAuthor').value,
                image: document.getElementById('postImage').value,
                readTime: document.getElementById('postReadTime').value,
                excerpt: document.getElementById('postExcerpt').value,
                content: document.getElementById('postContent').value,
                date: new Date().toISOString().split('T')[0],
                likes: 0,
                comments: []
            };

            if (editingPostId) {
                // Edit existing post
                const postIndex = blogPosts.findIndex(p => p.id === editingPostId);
                blogPosts[postIndex] = { ...blogPosts[postIndex], ...formData };
            } else {
                // Create new post
                const newPost = {
                    id: Date.now(),
                    ...formData
                };
                blogPosts.unshift(newPost);
            }

            hideEditor();
            renderPosts();
        });

        // Delete functionality
        const deleteModal = document.getElementById('deleteModal');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');

        function showDeleteModal(postId) {
            postToDelete = postId;
            deleteModal.classList.remove('hidden');
        }

        function hideDeleteModal() {
            deleteModal.classList.add('hidden');
            postToDelete = null;
        }

        confirmDelete.addEventListener('click', () => {
            blogPosts = blogPosts.filter(p => p.id !== postToDelete);
            hideDeleteModal();
            renderPosts();
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

                postElement.innerHTML = `
                    <div class="flex flex-col lg:flex-row gap-6">
                        <div class="lg:w-1/4">
                            <img src="${post.image}" alt="${post.title}" class="w-full h-48 lg:h-32 object-cover rounded-lg">
                        </div>
                        <div class="lg:w-2/4">
                            <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">${post.title}</h4>
                            <p class="text-gray-600 dark:text-gray-300 mb-3">${post.excerpt}</p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>${post.author}</span>
                                <span>•</span>
                                <span>${new Date(post.date).toLocaleDateString()}</span>
                                <span>•</span>
                                <span>${post.readTime}</span>
                                <span>•</span>
                                <span>${post.likes} likes</span>
                            </div>
                        </div>
                        <div class="lg:w-1/4 flex lg:flex-col gap-3">
                            <button onclick="showEditor(${JSON.stringify(post).replace(/"/g, '&quot;')})" class="flex-1 lg:flex-none px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition-all duration-300 flex items-center justify-center">
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
        renderPosts();
    </script>

@endsection
