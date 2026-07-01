<?php

namespace Tests\Feature\Blog;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_post_body_renders_markdown_as_html(): void
    {
        $post = Post::create([
            'title' => 'Articol de test',
            'body' => "# Titlu\n\nText cu **bold** si [link](https://example.com).",
            'published_at' => now(),
        ]);

        $response = $this->get(route('blog.show', $post->slug));

        $response->assertOk();
        $response->assertSee('<strong>bold</strong>', false);
        $response->assertSee('<a href="https://example.com">link</a>', false);
        $response->assertDontSee('**bold**');
    }
}
