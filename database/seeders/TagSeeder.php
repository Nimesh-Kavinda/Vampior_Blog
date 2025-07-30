<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample tags
        $tags = [
            ['name' => 'Web Development', 'color' => '#3B82F6'],
            ['name' => 'React', 'color' => '#10B981'],
            ['name' => 'CSS', 'color' => '#F59E0B'],
            ['name' => 'JavaScript', 'color' => '#EF4444'],
            ['name' => 'UI/UX Design', 'color' => '#8B5CF6'],
            ['name' => 'Dark Mode', 'color' => '#06B6D4'],
            ['name' => 'Artificial Intelligence', 'color' => '#F97316'],
            ['name' => 'Machine Learning', 'color' => '#84CC16'],
            ['name' => 'Technology', 'color' => '#EC4899'],
            ['name' => 'Programming', 'color' => '#6366F1'],
            ['name' => 'Frontend', 'color' => '#10B981'],
            ['name' => 'Backend', 'color' => '#F59E0B'],
            ['name' => 'Tutorial', 'color' => '#EF4444'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        // Assign tags to existing posts
        $posts = Post::all();

        if ($posts->count() > 0) {
            // Get all created tags
            $allTags = Tag::all();

            foreach ($posts as $post) {
                // Assign 2-4 random tags to each post
                $randomTags = $allTags->random(rand(2, 4));
                $post->tags()->attach($randomTags->pluck('id'));
            }
        }
    }
}
