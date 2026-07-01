<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\HaineResource\Pages\ListHaines;
use App\Filament\Resources\NewsletterResource\Pages\ListNewsletters;
use App\Filament\Resources\NewsletterSubscriberResource\Pages\ListNewsletterSubscribers;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\VideoResource\Pages\ListVideos;
use App\Models\Haina;
use App\Models\Newsletter;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use App\Notifications\SuperUserNotification;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentResourceFixesTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::factory()->create([
            'email' => Str::lower(Str::random(10)).'ioanclickmihalca@gmail.com',
        ]);
    }

    public function test_post_edit_page_route_is_registered(): void
    {
        $post = Post::create([
            'title' => 'Articol de test',
            'body' => 'Continut de test',
            'published_at' => now(),
            'featured_image' => 'blog-images/test.jpg',
        ]);

        $this->actingAs($this->adminUser())
            ->get(PostResource::getUrl('edit', ['record' => $post->getKey()]))
            ->assertOk();
    }

    public function test_post_meta_fields_round_trip_through_edit_form(): void
    {
        $post = Post::create([
            'title' => 'Articol de test',
            'body' => 'Continut de test',
            'published_at' => now(),
            'featured_image' => 'blog-images/test.jpg',
            'meta' => ['title' => 'Titlu vechi', 'description' => 'Descriere veche'],
        ]);

        $this->actingAs($this->adminUser());

        Livewire::test(EditPost::class, ['record' => $post->getKey()])
            ->assertFormSet([
                'meta.title' => 'Titlu vechi',
                'meta.description' => 'Descriere veche',
            ])
            ->fillForm([
                'meta.title' => 'Titlu nou',
                'meta.description' => 'Descriere noua',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame([
            'title' => 'Titlu nou',
            'description' => 'Descriere noua',
        ], $post->fresh()->meta);
    }

    public function test_haine_list_does_not_crash_on_unexpected_categorie(): void
    {
        Haina::create([
            'nume' => 'Produs neobisnuit',
            'categorie' => 'accesoriu',
            'descriere' => 'Descriere test',
            'culoare' => 'negru',
            'marimi_disponibile' => ['M'],
            'pret' => 59.99,
            'imagine_produs' => 'haine/imagini/test.jpg',
        ]);

        $this->actingAs($this->adminUser());

        Livewire::test(ListHaines::class)->assertSuccessful();
    }

    public function test_videos_table_has_edit_and_delete_row_actions(): void
    {
        $video = Video::create(['title' => 'Video de test']);

        $this->actingAs($this->adminUser());

        Livewire::test(ListVideos::class)
            ->assertActionExists(TestAction::make('edit')->table($video))
            ->assertActionExists(TestAction::make('delete')->table($video));
    }

    public function test_add_email_header_action_creates_subscriber(): void
    {
        $this->actingAs($this->adminUser());

        Livewire::test(ListNewsletters::class)
            ->callAction(TestAction::make('addEmail')->table(), data: [
                'recipient_name' => 'Maria Ionescu',
                'recipient_email' => 'maria.ionescu@example.com',
            ])
            ->assertNotified('Email adăugat cu succes');

        $this->assertDatabaseHas('newsletters', [
            'recipient_email' => 'maria.ionescu@example.com',
            'campaign_type' => Newsletter::TYPE_SUBSCRIBER,
        ]);
    }

    public function test_csv_import_reads_file_from_correct_disk_path(): void
    {
        $relativePath = 'test-imports/'.Str::random(10).'.csv';
        Storage::disk('local')->put($relativePath, "Ion Popescu,ion.popescu@example.com\n");

        $this->actingAs($this->adminUser());

        Livewire::test(ListNewsletterSubscribers::class)
            ->callAction(TestAction::make('importCsv')->table(), data: [
                'csv_file' => $relativePath,
                'skip_duplicates' => true,
            ])
            ->assertNotified('Import finalizat');

        $this->assertDatabaseHas('newsletters', [
            'recipient_email' => 'ion.popescu@example.com',
            'campaign_type' => Newsletter::TYPE_SUBSCRIBER,
        ]);

        Storage::disk('local')->delete($relativePath);
    }

    public function test_user_cannot_make_themselves_a_super_user(): void
    {
        $admin = $this->adminUser();
        $this->actingAs($admin);

        Livewire::test(ListUsers::class)
            ->callAction(TestAction::make('make_super_user')->table($admin))
            ->assertNotified('You cannot change your own user type.');

        $this->assertDatabaseMissing('users', [
            'id' => $admin->id,
            'usertype' => 'super_user',
        ]);
    }

    public function test_admin_can_make_another_user_a_super_user(): void
    {
        Notification::fake();

        $this->actingAs($this->adminUser());
        $target = User::factory()->create();

        Livewire::test(ListUsers::class)
            ->callAction(TestAction::make('make_super_user')->table($target))
            ->assertNotified("{$target->name} is now a super user.");

        $this->assertDatabaseHas('users', [
            'id' => $target->id,
            'usertype' => 'super_user',
        ]);

        Notification::assertSentTo($target, SuperUserNotification::class);
    }
}
