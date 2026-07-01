<?php

namespace Tests\Feature;

use App\Filament\Pages\HomepageSettings;
use App\Livewire\Welcome;
use App\Models\SiteSetting;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HomepageYoutubeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel('admin');
    }

    public function test_homepage_shows_the_youtube_player_when_a_link_is_set(): void
    {
        SiteSetting::factory()->create([
            'homepage_youtube_url' => 'https://youtu.be/dQw4w9WgXcQ',
        ]);

        Livewire::test(Welcome::class)
            ->assertSeeHtml('https://www.youtube.com/embed/dQw4w9WgXcQ');
    }

    public function test_homepage_hides_the_player_when_no_link_is_set(): void
    {
        Livewire::test(Welcome::class)
            ->assertDontSeeHtml('youtube.com/embed/');
    }

    public function test_admin_can_save_the_homepage_youtube_link(): void
    {
        $this->actingAs(User::factory()->create(['email' => 'ioanclickmihalca@gmail.com']));

        Livewire::test(HomepageSettings::class)
            ->fillForm(['homepage_youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(SiteSetting::class, [
            'homepage_youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);
    }

    public function test_it_rejects_a_non_youtube_link(): void
    {
        $this->actingAs(User::factory()->create(['email' => 'ioanclickmihalca@gmail.com']));

        Livewire::test(HomepageSettings::class)
            ->fillForm(['homepage_youtube_url' => 'https://vimeo.com/123456'])
            ->call('save')
            ->assertHasFormErrors(['homepage_youtube_url']);

        $this->assertDatabaseCount(SiteSetting::class, 0);
    }
}
