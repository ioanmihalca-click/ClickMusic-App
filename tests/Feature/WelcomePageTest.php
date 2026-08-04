<?php

namespace Tests\Feature;

use App\Livewire\Welcome;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_homepage_renders_the_poster_wall_background(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Click Music Romania')
            ->assertSee('poster-container', false)
            ->assertSee('poster-plane', false)
            ->assertSee('poster-overlay', false)
            ->assertSee('netflixBackground()', false);
    }

    public function test_the_poster_rows_scroll_in_a_single_direction(): void
    {
        Livewire::test(Welcome::class)
            ->assertSeeHtml('animation-duration')
            ->assertDontSeeHtml('poster-scroll-right');
    }

    public function test_the_scroll_dim_layer_replaces_the_blur_effect(): void
    {
        Livewire::test(Welcome::class)
            ->assertSeeHtml('scroll-dim');
    }

    public function test_the_legacy_background_markup_is_gone(): void
    {
        Livewire::test(Welcome::class)
            ->assertDontSeeHtml('home-fade')
            ->assertDontSeeHtml('x-init="init()"');
    }
}
