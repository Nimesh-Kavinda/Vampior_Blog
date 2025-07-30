<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class EditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create editor users
        $editor1 = User::create([
            'name' => 'Alex Morgan',
            'email' => 'alex@example.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
            'email_verified_at' => now()
        ]);

        $editor2 = User::create([
            'name' => 'Emma Rodriguez',
            'email' => 'emma@example.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
            'email_verified_at' => now()
        ]);

        $editor3 = User::create([
            'name' => 'Jordan Blake',
            'email' => 'jordan@example.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
            'email_verified_at' => now()
        ]);

        // Create posts for each editor
        Post::create([
            'title' => 'The Art of Modern Web Development',
            'excerpt' => 'Exploring the latest trends and techniques in contemporary web development, from React to advanced CSS animations.',
            'content' => 'In today\'s rapidly evolving digital landscape, web development has transformed into an art form that combines technical precision with creative vision. Modern frameworks like React, Vue, and Angular have revolutionized how we build user interfaces, while CSS has evolved to include powerful features like Grid, Flexbox, and custom properties.\n\nThe rise of JAMstack architecture has also changed how we think about web performance and security. By pre-building pages and serving them from CDNs, we can achieve lightning-fast load times while maintaining dynamic functionality through APIs and serverless functions.\n\nAs we look to the future, emerging technologies like WebAssembly, Progressive Web Apps, and AI-powered development tools promise to further transform the landscape of web development.',
            'author' => 'Alex Morgan',
            'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&h=400&fit=crop',
            'read_time' => '5 min read',
            'status' => 'published',
            'likes' => 42,
            'published_at' => now(),
            'editor_id' => $editor1->id
        ]);

        Post::create([
            'title' => 'Building Responsive Layouts with CSS Grid',
            'excerpt' => 'Master the power of CSS Grid to create flexible, responsive layouts that work beautifully on any device.',
            'content' => 'CSS Grid has revolutionized the way we approach layout design on the web. Unlike older techniques that relied on floats or positioning, Grid provides a two-dimensional layout system that makes it easy to create complex, responsive designs.\n\nThe key to mastering Grid is understanding its container and item relationship. The grid container defines the grid context, while grid items are the direct children that get placed within the grid.\n\nWith Grid, you can create layouts that automatically adapt to different screen sizes without needing to write complex media queries for every breakpoint.',
            'author' => 'Alex Morgan',
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=400&fit=crop',
            'read_time' => '7 min read',
            'status' => 'draft',
            'likes' => 18,
            'editor_id' => $editor1->id
        ]);

        Post::create([
            'title' => 'Mastering Dark Mode Design',
            'excerpt' => 'A comprehensive guide to creating beautiful and accessible dark mode interfaces that users will love.',
            'content' => 'Dark mode has become more than just a trend—it\'s now an essential feature that users expect from modern applications. Implementing dark mode effectively requires careful consideration of color contrast, accessibility, and user experience.\n\nWhen designing for dark mode, it\'s crucial to avoid pure black backgrounds, which can cause eye strain and make text harder to read. Instead, use dark grays and subtle color variations to create depth and hierarchy. Consider how your brand colors translate to dark themes, and ensure that all interactive elements remain clearly visible and accessible.\n\nTesting across different devices and lighting conditions is essential, as what looks good on a desktop monitor may not work well on a mobile device in bright sunlight.',
            'author' => 'Emma Rodriguez',
            'image' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=800&h=400&fit=crop',
            'read_time' => '8 min read',
            'status' => 'published',
            'likes' => 67,
            'published_at' => now(),
            'editor_id' => $editor2->id
        ]);

        Post::create([
            'title' => 'UX Design Principles for 2024',
            'excerpt' => 'Essential design principles every UX designer should follow to create exceptional user experiences.',
            'content' => 'User experience design is constantly evolving, and 2024 brings new challenges and opportunities. The focus has shifted towards more inclusive, accessible, and sustainable design practices.\n\nKey principles include designing for accessibility from the start, considering cognitive load, and creating interfaces that work well for users with diverse abilities and backgrounds.\n\nMicrointeractions and subtle animations play a crucial role in guiding users and providing feedback, but they must be used thoughtfully to enhance rather than distract from the core experience.',
            'author' => 'Emma Rodriguez',
            'image' => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?w=800&h=400&fit=crop',
            'read_time' => '6 min read',
            'status' => 'draft',
            'likes' => 23,
            'editor_id' => $editor2->id
        ]);

        Post::create([
            'title' => 'The Future of AI in Creative Industries',
            'excerpt' => 'How artificial intelligence is reshaping creativity and what it means for designers, writers, and artists.',
            'content' => 'Artificial intelligence is revolutionizing creative industries in ways we never imagined possible. From AI-generated art and music to automated design tools and writing assistants, technology is becoming an increasingly important collaborator in the creative process.\n\nFor designers, AI tools can automate repetitive tasks, generate initial concepts, and even suggest color palettes based on brand guidelines. Writers are using AI to overcome writer\'s block, generate ideas, and even help with research and fact-checking.\n\nHowever, this technological advancement also raises important questions about the nature of creativity, authorship, and the future role of human creators. Rather than replacing human creativity, the most successful applications of AI seem to augment and enhance human capabilities, allowing creators to focus on higher-level conceptual work while AI handles routine tasks.',
            'author' => 'Jordan Blake',
            'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=400&fit=crop',
            'read_time' => '12 min read',
            'status' => 'published',
            'likes' => 89,
            'published_at' => now(),
            'editor_id' => $editor3->id
        ]);

        Post::create([
            'title' => 'Machine Learning for Beginners',
            'excerpt' => 'A gentle introduction to machine learning concepts and practical applications for newcomers.',
            'content' => 'Machine learning can seem intimidating at first, but at its core, it\'s about teaching computers to recognize patterns and make predictions based on data. This field has applications in everything from recommendation systems to medical diagnosis.\n\nThere are three main types of machine learning: supervised learning (learning from labeled examples), unsupervised learning (finding patterns in unlabeled data), and reinforcement learning (learning through trial and error).\n\nThe key to getting started is to focus on understanding the fundamental concepts rather than getting lost in complex mathematical details. Start with simple projects and gradually work your way up to more complex applications.',
            'author' => 'Jordan Blake',
            'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&h=400&fit=crop',
            'read_time' => '10 min read',
            'status' => 'draft',
            'likes' => 34,
            'editor_id' => $editor3->id
        ]);
    }
}
