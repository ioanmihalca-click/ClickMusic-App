<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\MarkdownResponse\Facades\Markdown;
use Tests\TestCase;

class MarkdownResponseTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_returns_markdown_when_accept_header_is_set(): void
    {
        Markdown::fake();

        $response = $this->get('/blog', ['Accept' => 'text/markdown']);

        $response->assertOk();
        $this->assertStringContainsString('text/markdown', $response->headers->get('Content-Type'));
        Markdown::assertConverted();
    }

    public function test_blog_index_returns_markdown_for_md_suffix(): void
    {
        Markdown::fake();

        $response = $this->get('/blog.md');

        $response->assertOk();
        $this->assertStringContainsString('text/markdown', $response->headers->get('Content-Type'));
        Markdown::assertConverted();
    }

    public function test_blog_index_returns_html_normally(): void
    {
        Markdown::fake();

        $response = $this->get('/blog');

        $response->assertOk();
        $this->assertStringContainsString('text/html', $response->headers->get('Content-Type'));
        Markdown::assertNotConverted();
    }

    public function test_auth_only_route_is_not_converted_to_markdown(): void
    {
        Markdown::fake();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile', ['Accept' => 'text/markdown']);

        $response->assertOk();
        $this->assertStringContainsString('text/html', $response->headers->get('Content-Type'));
        Markdown::assertNotConverted();
    }
}
