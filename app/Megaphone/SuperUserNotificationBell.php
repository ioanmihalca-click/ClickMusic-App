<?php

namespace App\Megaphone;

use MBarlow\Megaphone\Types\BaseAnnouncement;

class SuperUserNotificationBell extends BaseAnnouncement
{
    public function __construct()
    {
        parent::__construct(
            'Ți-a fost atribuit rolul de Super_User!', // Title
            'Felicitari! ✅Ai acces PREMIUM gratuit pe viață.', // Body
            route('videoclipuri') 
        );
    }
}