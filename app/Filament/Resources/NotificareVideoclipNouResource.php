<?php



namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Illuminate\Http\Request; 
use Filament\Notifications\Notification;
use App\Notifications\NotificareVideoclipNou;
use Filament\Pages\Page; // Importăm clasa Page

class NotificareVideoclipNouResource extends Page  // Extindem clasa Page
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static string $view = 'filament.pages.send-video-notification'; // View-ul va fi în filament/pages
    protected static ?string $navigationLabel = 'Trimite mail video nou';
    protected static ?int $navigationSort = 3; 

    public $videoName;
    public $videoUrl;
    public $imageUrl;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('videoName')
                ->label('Nume Videoclip:')
                ->required(),
            Forms\Components\TextInput::make('videoUrl')
                ->label('URL Videoclip:')
                ->url()
                ->required(),
            Forms\Components\TextInput::make('imageUrl')
                ->label('URL Imagine Copertă (Cloudinary CDN)')
                ->url()
                ->required(),
        ];
    }

    public function submit()
    {
        $this->validate([
            'videoName' => ['required', 'string'],
            'videoUrl' => ['required', 'url'],
            'imageUrl' => ['required', 'url'],
        ]);
        $usersToNotify = User::all();

        foreach ($usersToNotify as $user) {
            $user->notify(new NotificareVideoclipNou(
            $this->videoUrl,   
            $this->imageUrl,    
            $this->videoName ));
        }
        
        Notification::make()
            ->title('Notificări trimise')
            ->success()
            ->send();

        // Clear the form fields after submitting
        $this->videoName = '';
        $this->videoUrl = '';
        $this->imageUrl = '';
    }
}