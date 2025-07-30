<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EditorController extends Controller
{
    /**
     * Display the editor dashboard
     */
    public function dashboard()
    {
        return view('editor.dashboard');
    }

    /**
     * Get posts for the current editor only
     */
    public function getPosts()
    {
        try {
            $posts = Post::where('editor_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

            return response()->json([
                'success' => true,
                'posts' => $posts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch posts: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new post for the current editor
     */
    public function storePost(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'excerpt' => 'required|string|max:500',
                'content' => 'required|string',
                'author' => 'required|string|max:255',
                'image' => 'nullable|url',
                'read_time' => 'nullable|string|max:50',
                'status' => 'required|in:draft,published'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $post = Post::create([
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'author' => $request->author,
                'image' => $request->image ?? 'https://images.unsplash.com/photo-1519337265831-281ec6cc8514?w=800&h=400&fit=crop',
                'read_time' => $request->read_time ?? '5 min read',
                'status' => $request->status,
                'editor_id' => Auth::id(),
                'published_at' => $request->status === 'published' ? now() : null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'post' => $post
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create post: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing post (only if it belongs to the current editor)
     */
    public function updatePost(Request $request, $id)
    {
        try {
            $post = Post::where('id', $id)
                       ->where('editor_id', Auth::id())
                       ->first();

            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found or you do not have permission to edit this post'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'excerpt' => 'required|string|max:500',
                'content' => 'required|string',
                'author' => 'required|string|max:255',
                'image' => 'nullable|url',
                'read_time' => 'nullable|string|max:50',
                'status' => 'required|in:draft,published'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $wasPublished = $post->status === 'published';
            $isNowPublished = $request->status === 'published';

            $post->update([
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'author' => $request->author,
                'image' => $request->image ?? $post->image,
                'read_time' => $request->read_time ?? $post->read_time,
                'status' => $request->status,
                'published_at' => (!$wasPublished && $isNowPublished) ? now() : $post->published_at,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'post' => $post->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update post: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a post (only if it belongs to the current editor)
     */
    public function deletePost($id)
    {
        try {
            $post = Post::where('id', $id)
                       ->where('editor_id', Auth::id())
                       ->first();

            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found or you do not have permission to delete this post'
                ], 404);
            }

            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete post: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle like for a post (only if it belongs to the current editor)
     */
    public function toggleLike($id)
    {
        try {
            $post = Post::where('id', $id)
                       ->where('editor_id', Auth::id())
                       ->first();

            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found or you do not have permission to modify this post'
                ], 404);
            }

            $post->increment('likes');

            return response()->json([
                'success' => true,
                'message' => 'Post liked successfully',
                'likes' => $post->likes
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to like post: ' . $e->getMessage()
            ], 500);
        }
    }
}
