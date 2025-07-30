<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
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
            $posts = Post::with('tags')
                        ->where('editor_id', Auth::id())
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
                'status' => 'required|in:draft,published',
                'tags' => 'nullable|string'
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

            // Handle tags
            if ($request->tags) {
                $this->attachTags($post, $request->tags);
            }

            // Load the post with tags for response
            $post->load('tags');

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
                'status' => 'required|in:draft,published',
                'tags' => 'nullable|string'
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

            // Handle tags
            $post->tags()->detach(); // Remove existing tags
            if ($request->tags) {
                $this->attachTags($post, $request->tags);
            }

            // Load the post with tags for response
            $post->load('tags');

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'post' => $post
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

    /**
     * Helper method to attach tags to a post
     */
    private function attachTags($post, $tagsString)
    {
        if (empty($tagsString)) {
            return;
        }

        // Split tags by comma and clean them
        $tagNames = array_map('trim', explode(',', $tagsString));
        $tagNames = array_filter($tagNames); // Remove empty strings

        $tagIds = [];

        foreach ($tagNames as $tagName) {
            if (!empty($tagName)) {
                // Find existing tag or create new one
                $tag = Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['color' => $this->getRandomTagColor()]
                );
                $tagIds[] = $tag->id;
            }
        }

        // Attach tags to the post
        $post->tags()->attach($tagIds);
    }

    /**
     * Get a random color for new tags
     */
    private function getRandomTagColor()
    {
        $colors = [
            '#3B82F6', // Blue
            '#10B981', // Green
            '#F59E0B', // Yellow
            '#EF4444', // Red
            '#8B5CF6', // Purple
            '#06B6D4', // Cyan
            '#F97316', // Orange
            '#84CC16', // Lime
            '#EC4899', // Pink
            '#6366F1'  // Indigo
        ];

        return $colors[array_rand($colors)];
    }
}
