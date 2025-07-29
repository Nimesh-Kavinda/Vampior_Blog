<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with posts
     */
    public function dashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('posts'));
    }

    /**
     * Get all posts as JSON
     */
    public function getPosts(): JsonResponse
    {
        $posts = Post::orderBy('created_at', 'desc')->get()->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'author' => $post->author,
                'image' => $post->image,
                'readTime' => $post->read_time,
                'date' => $post->created_at->format('Y-m-d'),
                'likes' => $post->likes,
                'status' => $post->status,
                'published_at' => $post->published_at?->format('Y-m-d'),
                'comments' => [] // You can add comments relationship later
            ];
        });

        return response()->json($posts);
    }

    /**
     * Store a new post
     */
    public function storePost(StorePostRequest $request): JsonResponse
    {
        $post = Post::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $request->image,
            'read_time' => $request->readTime ?? '5 min read',
            'status' => $request->status ?? 'published',
            'published_at' => ($request->status ?? 'published') === 'published' ? now() : null,
            'likes' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'author' => $post->author,
                'image' => $post->image,
                'readTime' => $post->read_time,
                'date' => $post->created_at->format('Y-m-d'),
                'likes' => $post->likes,
                'status' => $post->status,
                'comments' => []
            ]
        ], 201);
    }

    /**
     * Update an existing post
     */
    public function updatePost(StorePostRequest $request, $id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        $post->update([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $request->image,
            'read_time' => $request->readTime ?? $post->read_time,
            'status' => $request->status ?? $post->status,
            'published_at' => ($request->status ?? $post->status) === 'published' && !$post->published_at ? now() : $post->published_at
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'author' => $post->author,
                'image' => $post->image,
                'readTime' => $post->read_time,
                'date' => $post->created_at->format('Y-m-d'),
                'likes' => $post->likes,
                'status' => $post->status,
                'comments' => []
            ]
        ]);
    }

    /**
     * Delete a post
     */
    public function deletePost($id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }

    /**
     * Toggle post like
     */
    public function toggleLike($id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        $post->increment('likes');

        return response()->json([
            'success' => true,
            'likes' => $post->likes
        ]);
    }

    /**
     * Get all users as JSON
     */
    public function getUsers(): JsonResponse
    {
        $users = User::orderBy('created_at', 'desc')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'createdDate' => $user->created_at->format('Y-m-d'),
                'lastLogin' => 'Never', // We can implement this later
                'status' => 'active' // You can add a status column later if needed
            ];
        });

        return response()->json($users);
    }

    /**
     * Store a new user
     */
    public function storeUser(StoreUserRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'createdDate' => $user->created_at->format('Y-m-d'),
                'lastLogin' => 'Never',
                'status' => 'active'
            ]
        ], 201);
    }

    /**
     * Update an existing user
     */
    public function updateUser(StoreUserRequest $request, $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Prevent editing admin users by non-admin users
        if ($user->role === 'admin' && auth()->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to edit admin users'
            ], 403);
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'createdDate' => $user->created_at->format('Y-m-d'),
                'lastLogin' => 'Never',
                'status' => 'active'
            ]
        ]);
    }

    /**
     * Delete a user
     */
    public function deleteUser($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Prevent deleting admin users
        if ($user->role === 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Admin users cannot be deleted'
            ], 403);
        }

        // Prevent users from deleting themselves
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
