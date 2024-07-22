<?php

return [
    /*
     * Model that has the "Notifiable" and "HasMegaphone" Traits
     */
    'model' => \App\Models\User::class,

    /*
     * Array of all the notification types to display in Megaphone
     */
    'types' => [
        \MBarlow\Megaphone\Types\General::class,
        \MBarlow\Megaphone\Types\NewFeature::class,
        \MBarlow\Megaphone\Types\Important::class,
    ],

    /*
     * Custom notification types specific to your App
     */
    'customTypes' => [
        \App\Megaphone\CommentReplyNotification::class => 'vendor.megaphone.comment-reply-notification', 
    ],

    /*
     * Array of Notification types available within MegaphoneAdmin Component or
     * leave as null to show all types / customTypes
     *
     * 'adminTypeList' => [
     *     \MBarlow\Megaphone\Types\NewFeature::class,
     *     \MBarlow\Megaphone\Types\Important::class,
     * ],
     */
    'adminTypeList' => null,

    /*
     * Clear Megaphone notifications older than....
     */
    'clearAfter' => '2 weeks',

    /*
     * Option for setting the icon to show actual count of unread Notifications or
     * show a dot instead
     */
    'showCount' => true,
];
