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
            ],
            [
                'title' => 'Building Responsive Layouts with CSS Grid',
                'excerpt' => 'Master the power of CSS Grid to create complex, responsive layouts with clean and maintainable code.',
                'content' => "CSS Grid has revolutionized how we approach layout design on the web. Unlike Flexbox, which is primarily one-dimensional, Grid allows us to work with both rows and columns simultaneously, making it perfect for complex layouts.\n\nOne of the most powerful features of CSS Grid is its ability to create responsive layouts without media queries. Using functions like minmax(), auto-fit, and auto-fill, we can create layouts that automatically adapt to different screen sizes.\n\nGrid also excels at overlapping elements and creating magazine-style layouts. With features like grid-template-areas, we can name our grid areas and position elements using semantic names rather than line numbers, making our CSS more readable and maintainable.\n\nWhen combined with modern CSS features like custom properties and container queries, Grid becomes an incredibly powerful tool for creating sophisticated, responsive designs.",
                'author' => 'Sarah Chen',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=400&fit=crop',
                'read_time' => '7 min read',
                'likes' => 34,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(12),
                'created_at' => Carbon::now()->subDays(12),
                'updated_at' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'JavaScript Performance Optimization Tips',
                'excerpt' => 'Learn essential techniques to optimize your JavaScript code and improve application performance.',
                'content' => "JavaScript performance optimization is crucial for creating smooth, fast web applications. Modern applications often handle complex interactions and large datasets, making efficient code more important than ever.\n\nOne of the first areas to focus on is DOM manipulation. Minimizing direct DOM access and batching DOM updates can significantly improve performance. Consider using techniques like document fragments or virtual DOM libraries for complex updates.\n\nMemory management is another critical aspect. Avoid memory leaks by properly cleaning up event listeners, clearing intervals and timeouts, and being mindful of closures that might retain references to large objects.\n\nFor computation-heavy tasks, consider using Web Workers to move processing off the main thread. This prevents blocking the UI and keeps your application responsive. Additionally, techniques like debouncing and throttling can help manage expensive operations triggered by user interactions.\n\nFinally, use browser developer tools to profile your application and identify bottlenecks. Tools like Chrome DevTools provide detailed insights into performance issues and help you make data-driven optimization decisions.",
                'author' => 'Michael Torres',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&h=400&fit=crop',
                'read_time' => '10 min read',
                'likes' => 76,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(15),
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'title' => 'The Art of Minimalist UI Design',
                'excerpt' => 'Discover how less can be more in user interface design and create elegant, functional experiences.',
                'content' => "Minimalist design is not just about removing elements—it's about finding the perfect balance between functionality and simplicity. Every element that remains must serve a purpose and contribute to the overall user experience.\n\nThe foundation of minimalist UI design lies in understanding your users' primary goals. By focusing on these core objectives, you can eliminate distractions and create clear pathways through your interface. This approach often results in faster task completion and reduced cognitive load.\n\nTypography plays a crucial role in minimalist design. With fewer visual elements competing for attention, your choice of fonts, spacing, and hierarchy becomes even more important. Consider using a limited type scale and ensure sufficient contrast for accessibility.\n\nWhitespace, or negative space, is perhaps the most powerful tool in minimalist design. It creates breathing room, establishes hierarchy, and draws attention to important elements. Don't think of whitespace as empty—think of it as a design element that enhances usability.\n\nColor in minimalist design should be purposeful. A limited color palette can create visual coherence while strategic use of accent colors can guide user attention and indicate interactive elements.",
                'author' => 'Luna Park',
                'image' => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?w=800&h=400&fit=crop',
                'read_time' => '6 min read',
                'likes' => 91,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(18),
                'created_at' => Carbon::now()->subDays(18),
                'updated_at' => Carbon::now()->subDays(18),
            ],
            [
                'title' => 'Getting Started with TypeScript',
                'excerpt' => 'A beginner-friendly introduction to TypeScript and how it can improve your JavaScript development workflow.',
                'content' => "TypeScript has become an essential tool for modern JavaScript development, offering static type checking and enhanced IDE support that can catch errors before runtime.\n\nThe beauty of TypeScript lies in its gradual adoption approach. You can start by simply renaming your .js files to .ts and gradually add type annotations where they provide the most value. This makes it easy to introduce TypeScript to existing projects without a complete rewrite.\n\nOne of the biggest advantages is improved developer experience. With TypeScript, your IDE can provide better autocomplete, refactoring support, and inline documentation. This leads to faster development and fewer bugs in production.\n\nTypeScript's type system is incredibly powerful yet flexible. You can define complex types, use generics for reusable code, and even create conditional types for advanced scenarios. The compiler options allow you to choose how strict you want the type checking to be.\n\nFor teams, TypeScript serves as documentation that never goes out of date. Function signatures become self-documenting, and breaking changes are caught at compile time rather than in production.\n\nWhile there's a learning curve, the investment in TypeScript pays dividends in code quality, maintainability, and developer productivity.",
                'author' => 'David Kim',
                'image' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=800&h=400&fit=crop',
                'read_time' => '8 min read',
                'likes' => 55,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(21),
                'created_at' => Carbon::now()->subDays(21),
                'updated_at' => Carbon::now()->subDays(21),
            ],
            [
                'title' => 'Web Accessibility: Building for Everyone',
                'excerpt' => 'Essential principles and practical tips for creating accessible web experiences that work for all users.',
                'content' => "Web accessibility isn't just about compliance—it's about creating inclusive experiences that work for everyone. When we design with accessibility in mind, we often end up with better experiences for all users.\n\nSemantic HTML is the foundation of accessible web development. Using proper heading hierarchy, form labels, and semantic elements like nav, main, and article helps screen readers understand your content structure. This also improves SEO and makes your code more maintainable.\n\nKeyboard navigation is crucial for users who can't use a mouse. Ensure all interactive elements are reachable via keyboard and provide clear focus indicators. The tab order should follow a logical sequence that matches the visual layout.\n\nColor and contrast requirements aren't just guidelines—they're essential for users with visual impairments. Use tools to check color contrast ratios and ensure information isn't conveyed through color alone. Consider how your design works for users with color blindness.\n\nScreen reader compatibility requires thoughtful markup and ARIA attributes. While ARIA can enhance accessibility, it should supplement, not replace, semantic HTML. Test your sites with actual screen readers to understand the user experience.\n\nAccessibility testing should be integrated into your development workflow. Use automated tools for initial checks, but remember that manual testing is essential for catching issues that tools miss.",
                'author' => 'Rachel Green',
                'image' => 'https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=800&h=400&fit=crop',
                'read_time' => '11 min read',
                'likes' => 103,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(24),
                'created_at' => Carbon::now()->subDays(24),
                'updated_at' => Carbon::now()->subDays(24),
            ],
            [
                'title' => 'The Rise of Progressive Web Apps',
                'excerpt' => 'Explore how PWAs are bridging the gap between web and native applications.',
                'content' => "Progressive Web Apps (PWAs) represent a significant shift in how we think about web applications. By combining the best features of web and native apps, PWAs offer app-like experiences that work across all devices and platforms.\n\nThe core technologies behind PWAs include Service Workers for offline functionality, Web App Manifests for installation capabilities, and responsive design for universal compatibility. These technologies work together to create experiences that feel native while maintaining the web's inherent advantages.\n\nService Workers are perhaps the most powerful feature of PWAs. They enable offline functionality, background sync, and push notifications. This means users can continue using your app even without an internet connection, with data syncing when connectivity returns.\n\nInstallability is another key advantage. Users can add PWAs to their home screens without going through app stores. This reduces friction and makes it easier for users to access your app. PWAs also benefit from automatic updates, ensuring users always have the latest version.\n\nPerformance is crucial for PWA success. Techniques like app shell architecture, lazy loading, and efficient caching strategies help PWAs load quickly and feel responsive. The PRPL pattern (Push, Render, Pre-cache, Lazy-load) provides a framework for optimizing PWA performance.\n\nMajor companies like Twitter, Pinterest, and Starbucks have seen significant improvements in engagement and conversion rates after implementing PWAs, demonstrating their potential for business impact.",
                'author' => 'Alex Rivera',
                'image' => 'https://images.unsplash.com/photo-1563207153-f403bf289096?w=800&h=400&fit=crop',
                'read_time' => '9 min read',
                'likes' => 68,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(27),
                'created_at' => Carbon::now()->subDays(27),
                'updated_at' => Carbon::now()->subDays(27),
            ],
            [
                'title' => 'CSS Animations That Enhance User Experience',
                'excerpt' => 'Learn how to use CSS animations effectively to improve usability and delight users.',
                'content' => "CSS animations, when used thoughtfully, can significantly enhance user experience by providing visual feedback, guiding attention, and creating more engaging interfaces. The key is knowing when and how to use them effectively.\n\nMicro-interactions are small animations that respond to user actions, like button hover effects or form validation feedback. These subtle animations provide immediate visual confirmation that an action has been registered, improving the perceived responsiveness of your interface.\n\nTransitions between states should feel natural and purposeful. When elements change position, size, or color, smooth transitions help users understand the relationship between different states. Use easing functions that feel organic—ease-out often works well for most interface animations.\n\nLoading animations serve both functional and aesthetic purposes. They indicate that something is happening and help manage user expectations. However, be careful not to make loading animations too entertaining, as they might make users feel that loading is taking longer than it actually is.\n\nPerformance considerations are crucial for CSS animations. Stick to animating transform and opacity properties when possible, as these can be hardware-accelerated. Avoid animating layout properties like width, height, or position, as these trigger expensive reflows.\n\nAccessibility should always be considered. Some users prefer reduced motion, so respect the prefers-reduced-motion media query and provide alternative feedback mechanisms for users who have motion sensitivity.",
                'author' => 'Sophie Martinez',
                'image' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800&h=400&fit=crop',
                'read_time' => '7 min read',
                'likes' => 81,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(30),
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
