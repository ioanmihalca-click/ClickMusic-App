<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class HomepageSettings extends Page
{
    protected string $view = 'filament.pages.homepage-settings';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|UnitEnum|null $navigationGroup = 'Setări';

    protected static ?string $navigationLabel = 'Setări Homepage';

    protected static ?string $title = 'Setări Homepage';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    TextInput::make('homepage_youtube_url')
                        ->label('Link clip YouTube')
                        ->placeholder('https://www.youtube.com/watch?v=...')
                        ->helperText('Lipește link-ul clipului YouTube care va fi afișat pe pagina principală. Lasă gol pentru a-l ascunde.')
                        ->url()
                        ->maxLength(255)
                        ->rule(fn (): Closure => function (string $attribute, mixed $value, Closure $fail): void {
                            if (filled($value) && SiteSetting::youtubeId($value) === null) {
                                $fail('Link-ul introdus nu pare a fi un link YouTube valid.');
                            }
                        }),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Salvează')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $record = $this->getRecord() ?? new SiteSetting;

        $record->fill($data);
        $record->save();

        Notification::make()
            ->success()
            ->title('Setările au fost salvate.')
            ->send();
    }

    public function getRecord(): ?SiteSetting
    {
        return SiteSetting::query()->first();
    }
}
