<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Art of Modern Web Development',
                'excerpt' => 'Exploring the latest trends and techniques in contemporary web development, from React to advanced CSS animations.',
                'content' => "In today's rapidly evolving digital landscape, web development has transformed into an art form that combines technical precision with creative vision. Modern frameworks like React, Vue, and Angular have revolutionized how we build user interfaces, while CSS has evolved to include powerful features like Grid, Flexbox, and custom properties.\n\nThe rise of JAMstack architecture has also changed how we think about web performance and security. By pre-building pages and serving them from CDNs, we can achieve lightning-fast load times while maintaining dynamic functionality through APIs and serverless functions.\n\nAs we look to the future, emerging technologies like WebAssembly, Progressive Web Apps, and AI-powered development tools promise to further transform the landscape of web development.",
                'author' => 'Alex Morgan',
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&h=400&fit=crop',
                'read_time' => '5 min read',
                'likes' => 42,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(4),
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'title' => 'Mastering Dark Mode Design',
                'excerpt' => 'A comprehensive guide to creating beautiful and accessible dark mode interfaces that users will love.',
                'content' => "Dark mode has become more than just a trend—it's now an essential feature that users expect from modern applications. Implementing dark mode effectively requires careful consideration of color contrast, accessibility, and user experience.\n\nWhen designing for dark mode, it's crucial to avoid pure black backgrounds, which can cause eye strain and make text harder to read. Instead, use dark grays and subtle color variations to create depth and hierarchy. Consider how your brand colors translate to dark themes, and ensure that all interactive elements remain clearly visible and accessible.\n\nTesting across different devices and lighting conditions is essential, as what looks good on a desktop monitor may not work well on a mobile device in bright sunlight.",
                'author' => 'Emma Rodriguez',
                'image' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=800&h=400&fit=crop',
                'read_time' => '8 min read',
                'likes' => 67,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(7),
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'The Future of AI in Creative Industries',
                'excerpt' => 'How artificial intelligence is reshaping creativity and what it means for designers, writers, and artists.',
                'content' => "Artificial intelligence is revolutionizing creative industries in ways we never imagined possible. From AI-generated art and music to automated design tools and writing assistants, technology is becoming an increasingly important collaborator in the creative process.\n\nFor designers, AI tools can automate repetitive tasks, generate initial concepts, and even suggest color palettes based on brand guidelines. Writers are using AI to overcome writer's block, generate ideas, and even help with research and fact-checking.\n\nHowever, this technological advancement also raises important questions about the nature of creativity, authorship, and the future role of human creators. Rather than replacing human creativity, the most successful applications of AI seem to augment and enhance human capabilities, allowing creators to focus on higher-level conceptual work while AI handles routine tasks.",
                'author' => 'Jordan Blake',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=400&fit=crop',
                'read_time' => '12 min read',
                'likes' => 89,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(9),
                'created_at' => Carbon::now()->subDays(9),
                'updated_at' => Carbon::now()->subDays(9),
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
