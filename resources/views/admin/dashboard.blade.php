@extends('layouts.app')

@section('content')

 <header class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 dark:from-purple-400 dark:via-pink-400 dark:to-red-400 bg-clip-text text-transparent">
                        Admin Dashboard
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300">
                        Manage posts, users, and system settings
                    </p>
                </div>
                <div class="mt-6 md:mt-0 flex flex-col sm:flex-row gap-3">
                    <button id="createNewPost" class="px-8 py-3 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create New Post
                    </button>
                    <button id="createNewUser" class="px-8 py-3 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New User
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 pb-20">
        <!-- Tab Navigation -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-2">
                <button id="postsTab" class="tab-button active px-6 py-3 rounded-lg font-medium">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Posts Management
                </button>
                <button id="usersTab" class="tab-button px-6 py-3 rounded-lg font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    User Management
                </button>
            </div>
        </div>

        <!-- Post Editor Form (Hidden by default) -->
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

        <!-- User Editor Form (Hidden by default) -->
        <div id="userForm" class="hidden mb-12">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-purple-200/50 dark:border-purple-500/20 p-8 shadow-lg">
                <h3 id="userFormTitle" class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Add New User</h3>

                <form id="userFormElement" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Full Name</label>
                            <input type="text" id="userFullName" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="Full name...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="userEmail" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="user@example.com">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div id="passwordField">
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Password</label>
                            <input type="password" id="userPassword" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="Enter password...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Role</label>
                            <select id="userType" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                                <option value="reader">Reader</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="px-8 py-3 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save User
                        </button>
                        <button type="button" id="cancelUserEdit" class="px-8 py-3 rounded-lg font-medium transition-all duration-300 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Posts List -->
        <div id="postsList">
            <h3 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white">Blog Posts</h3>
            <div id="postsContainer" class="grid gap-6">
                <!-- Posts will be rendered here -->
            </div>
        </div>

        <!-- Users List -->
        <div id="usersList" class="hidden">
            <h3 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white">System Users</h3>
            <div id="usersContainer" class="grid gap-6">
                <!-- Users will be rendered here -->
            </div>
        </div>
    </main>

    <!-- Delete Post Confirmation Modal -->
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

    <!-- Delete User Confirmation Modal -->
   <div id="deleteUserModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-md w-full">
            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Delete User</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Are you sure you want to delete this user? This action cannot be undone.</p>
            <div class="flex space-x-4">
                <button id="confirmUserDelete" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all duration-300">
                    Delete
                </button>
                <button id="cancelUserDelete" class="px-6 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium transition-all duration-300">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        // CSRF token for Laravel
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        // Blog posts data - will be loaded from backend
        let blogPosts = [];

        // Users data - will be loaded from backend
        let users = [];

        let editingPostId = null;
        let editingUserId = null;
        let postToDelete = null;
        let userToDelete = null;
        let currentTab = 'posts';

        // Load posts from backend
        async function loadPosts() {
            try {
                const response = await fetch('/admin/posts', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    blogPosts = await response.json();
                    renderPosts();
                } else {
                    console.error('Failed to load posts');
                }
            } catch (error) {
                console.error('Error loading posts:', error);
            }
        }

        // Save post (create or update)
        async function savePost(postData) {
            const url = editingPostId ? `/admin/posts/${editingPostId}` : '/admin/posts';
            const method = editingPostId ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(postData)
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(result.message, 'success');
                    hideEditor();
                    loadPosts(); // Reload posts
                } else {
                    showNotification(result.message || 'Failed to save post', 'error');
                    if (result.errors) {
                        console.error('Validation errors:', result.errors);
                    }
                }
            } catch (error) {
                console.error('Error saving post:', error);
                showNotification('Error saving post', 'error');
            }
        }

        // Delete post
        async function deletePost(postId) {
            try {
                const response = await fetch(`/admin/posts/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(result.message, 'success');
                    loadPosts(); // Reload posts
                } else {
                    showNotification(result.message || 'Failed to delete post', 'error');
                }
            } catch (error) {
                console.error('Error deleting post:', error);
                showNotification('Error deleting post', 'error');
            }
        }

        // Load users from backend
        async function loadUsers() {
            try {
                const response = await fetch('/admin/users', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    users = await response.json();
                    renderUsers();
                } else {
                    console.error('Failed to load users');
                }
            } catch (error) {
                console.error('Error loading users:', error);
            }
        }

        // Save user (create or update)
        async function saveUser(userData) {
            const url = editingUserId ? `/admin/users/${editingUserId}` : '/admin/users';
            const method = editingUserId ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(userData)
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(result.message, 'success');
                    hideUserForm();
                    loadUsers(); // Reload users
                } else {
                    showNotification(result.message || 'Failed to save user', 'error');
                    if (result.errors) {
                        console.error('Validation errors:', result.errors);
                        // Display validation errors
                        Object.keys(result.errors).forEach(field => {
                            showNotification(result.errors[field][0], 'error');
                        });
                    }
                }
            } catch (error) {
                console.error('Error saving user:', error);
                showNotification('Error saving user', 'error');
            }
        }

        // Delete user
        async function deleteUser(userId) {
            try {
                const response = await fetch(`/admin/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(result.message, 'success');
                    loadUsers(); // Reload users
                } else {
                    showNotification(result.message || 'Failed to delete user', 'error');
                }
            } catch (error) {
                console.error('Error deleting user:', error);
                showNotification('Error deleting user', 'error');
            }
        }

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

        // Tab functionality
        const postsTab = document.getElementById('postsTab');
        const usersTab = document.getElementById('usersTab');
        const postsList = document.getElementById('postsList');
        const usersList = document.getElementById('usersList');

        function switchToTab(tabName) {
            currentTab = tabName;

            // Update tab buttons
            postsTab.classList.remove('active');
            usersTab.classList.remove('active');
            postsTab.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            usersTab.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');

            if (tabName === 'posts') {
                postsTab.classList.add('active');
                postsTab.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                postsList.classList.remove('hidden');
                usersList.classList.add('hidden');
            } else {
                usersTab.classList.add('active');
                usersTab.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                usersList.classList.remove('hidden');
                postsList.classList.add('hidden');
            }

            // Hide any open forms
            hideEditor();
            hideUserForm();
        }

        postsTab.addEventListener('click', () => switchToTab('posts'));
        usersTab.addEventListener('click', () => switchToTab('users'));

        // Post editor functionality
        const editorForm = document.getElementById('editorForm');
        const createNewPostBtn = document.getElementById('createNewPost');
        const cancelEditBtn = document.getElementById('cancelEdit');
        const postForm = document.getElementById('postForm');
        const editorTitle = document.getElementById('editorTitle');

        createNewPostBtn.addEventListener('click', () => {
            switchToTab('posts');
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
            if (currentTab === 'posts') {
                postsList.classList.add('hidden');
            }
            editorForm.scrollIntoView({ behavior: 'smooth' });
        }

        function hideEditor() {
            editorForm.classList.add('hidden');
            if (currentTab === 'posts') {
                postsList.classList.remove('hidden');
            }
            editingPostId = null;
            postForm.reset();
        }

        // User form functionality
        const userForm = document.getElementById('userForm');
        const createNewUserBtn = document.getElementById('createNewUser');
        const cancelUserEditBtn = document.getElementById('cancelUserEdit');
        const userFormElement = document.getElementById('userFormElement');
        const userFormTitle = document.getElementById('userFormTitle');

        createNewUserBtn.addEventListener('click', () => {
            switchToTab('users');
            showUserForm();
        });

        cancelUserEditBtn.addEventListener('click', () => {
            hideUserForm();
        });

        function showUserForm(user = null) {
            editingUserId = user ? user.id : null;
            userFormTitle.textContent = user ? 'Edit User' : 'Add New User';

            if (user) {
                document.getElementById('userEmail').value = user.email;
                document.getElementById('userFullName').value = user.name;
                document.getElementById('userType').value = user.role;
                document.getElementById('passwordField').style.display = 'none';
            } else {
                userFormElement.reset();
                document.getElementById('passwordField').style.display = 'block';
            }

            userForm.classList.remove('hidden');
            if (currentTab === 'users') {
                usersList.classList.add('hidden');
            }
            userForm.scrollIntoView({ behavior: 'smooth' });
        }

        function hideUserForm() {
            userForm.classList.add('hidden');
            if (currentTab === 'users') {
                usersList.classList.remove('hidden');
            }
            editingUserId = null;
            userFormElement.reset();
        }

        // Form submissions
        postForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = {
                title: document.getElementById('postTitle').value,
                author: document.getElementById('postAuthor').value,
                image: document.getElementById('postImage').value,
                readTime: document.getElementById('postReadTime').value,
                excerpt: document.getElementById('postExcerpt').value,
                content: document.getElementById('postContent').value,
                status: 'published' // You can add a status selector if needed
            };

            savePost(formData);
        });

        userFormElement.addEventListener('submit', (e) => {
            e.preventDefault();

            const userData = {
                name: document.getElementById('userFullName').value,
                email: document.getElementById('userEmail').value,
                role: document.getElementById('userType').value
            };

            // Only include password if it's provided (for new users or password updates)
            const password = document.getElementById('userPassword').value;
            if (password) {
                userData.password = password;
            }

            saveUser(userData);
        });

        // Delete functionality
        const deleteModal = document.getElementById('deleteModal');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');

        const deleteUserModal = document.getElementById('deleteUserModal');
        const confirmUserDelete = document.getElementById('confirmUserDelete');
        const cancelUserDelete = document.getElementById('cancelUserDelete');

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

        function showDeleteUserModal(userId) {
            userToDelete = userId;
            deleteUserModal.classList.remove('hidden');
        }

        function hideDeleteUserModal() {
            deleteUserModal.classList.add('hidden');
            userToDelete = null;
        }

        confirmDelete.addEventListener('click', () => {
            if (postToDelete) {
                deletePost(postToDelete);
                hideDeleteModal();
            }
        });

        cancelDelete.addEventListener('click', hideDeleteModal);

        confirmUserDelete.addEventListener('click', () => {
            if (userToDelete) {
                deleteUser(userToDelete);
                hideDeleteUserModal();
            }
        });

        cancelUserDelete.addEventListener('click', hideDeleteUserModal);

        // Close modals when clicking outside
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                hideDeleteModal();
            }
        });

        deleteUserModal.addEventListener('click', (e) => {
            if (e.target === deleteUserModal) {
                hideDeleteUserModal();
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

        // Render users
        function renderUsers() {
            const container = document.getElementById('usersContainer');
            container.innerHTML = '';

            if (users.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <p class="text-xl text-gray-500 dark:text-gray-400">No users found</p>
                        <p class="text-gray-400 dark:text-gray-500 mt-2">Add your first user to get started</p>
                    </div>
                `;
                return;
            }

            users.forEach(user => {
                const userElement = document.createElement('div');
                userElement.className = 'card-hover bg-white dark:bg-gray-800/50 rounded-2xl border border-purple-200/50 dark:border-purple-500/20 p-6 shadow-lg';

                const roleColors = {
                    admin: 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300',
                    editor: 'bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300',
                    reader: 'bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300'
                };

                userElement.innerHTML = `
                    <div class="flex flex-col lg:flex-row gap-6">
                        <div class="lg:w-1/6 flex justify-center lg:justify-start">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-xl">${user.name.charAt(0)}</span>
                            </div>
                        </div>
                        <div class="lg:w-3/6">
                            <div class="flex items-center space-x-3 mb-2">
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white">${user.name}</h4>
                                <span class="px-3 py-1 rounded-full text-sm font-medium ${roleColors[user.role]}">${user.role}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-3">${user.email}</p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>Joined: ${new Date(user.createdDate).toLocaleDateString()}</span>
                                <span>•</span>
                                <span>Last login: ${user.lastLogin === 'Never' ? 'Never' : new Date(user.lastLogin).toLocaleDateString()}</span>
                            </div>
                        </div>
                        <div class="lg:w-2/6 flex lg:flex-col gap-3">
                            <button onclick="showUserForm(${JSON.stringify(user).replace(/"/g, '&quot;')})" class="flex-1 lg:flex-none px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition-all duration-300 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit User
                            </button>
                            ${user.role !== 'admin' ? `
                            <button onclick="showDeleteUserModal(${user.id})" class="flex-1 lg:flex-none px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all duration-300 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete User
                            </button>
                            ` : '<div class="flex-1 lg:flex-none px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 rounded-lg font-medium text-center">Protected User</div>'}
                        </div>
                    </div>
                `;

                container.appendChild(userElement);
            });
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent browser back button
            history.pushState(null, null, window.location.href);
            window.addEventListener('popstate', function(event) {
                history.pushState(null, null, window.location.href);
            });

            loadPosts(); // Load posts from backend
            loadUsers(); // Load users from backend
        });

        // Show notification
        function showNotification(message, type = 'success') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>

@endsection
