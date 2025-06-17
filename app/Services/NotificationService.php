<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;

class NotificationService
{
    /**
     * Send a notification to a specific user
     *
     * @param User $user The user to send the notification to
     * @param string $type The type of notification
     * @param string $title The notification title
     * @param string|null $body Optional body text
     * @param string|null $link Optional link
     * @param array|null $data Optional additional data
     * @return Notification
     */
    public function sendToUser(User $user, string $type, string $title, ?string $body = null, ?string $link = null, ?array $data = null)
    {
        return $user->notifications()->create([
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'link' => $link,
            'data' => $data,
        ]);
    }

    /**
     * Send a notification to multiple users
     *
     * @param array $userIds Array of user IDs
     * @param string $type The type of notification
     * @param string $title The notification title
     * @param string|null $body Optional body text
     * @param string|null $link Optional link
     * @param array|null $data Optional additional data
     * @return void
     */
    public function sendToMultipleUsers(array $userIds, string $type, string $title, ?string $body = null, ?string $link = null, ?array $data = null)
    {
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            $this->sendToUser($user, $type, $title, $body, $link, $data);
        }
    }

    /**
     * Send a notification to all users
     *
     * @param string $type The type of notification
     * @param string $title The notification title
     * @param string|null $body Optional body text
     * @param string|null $link Optional link
     * @param array|null $data Optional additional data
     * @return void
     */
    public function sendToAllUsers(string $type, string $title, ?string $body = null, ?string $link = null, ?array $data = null)
    {
        $users = User::all();

        foreach ($users as $user) {
            $this->sendToUser($user, $type, $title, $body, $link, $data);
        }
    }

    /**
     * Send a comment reply notification
     *
     * @param User $user User to notify
     * @param string $commenterName Name of the user who commented
     * @param string $videoTitle Title of the video
     * @param string $commentBody Comment body
     * @param string $url URL to the video
     * @return Notification
     */
    public function sendCommentReplyNotification(User $user, string $commenterName, string $videoTitle, string $commentBody, string $url)
    {
        return $this->sendToUser(
            $user,
            'comment_reply',
            $commenterName . ' a răspuns la comentariul tău de la "' . $videoTitle . '"!',
            $commentBody,
            $url,
            ['video_title' => $videoTitle]
        );
    }

    /**
     * Send a notification to admin about a new comment
     *
     * @param User $admin Admin user to notify
     * @param string $commenterName Name of the user who commented
     * @param string $videoTitle Title of the video
     * @param string $commentBody Comment body
     * @param string $url URL to the video
     * @return Notification
     */
    public function sendNewCommentNotification(User $admin, string $commenterName, string $videoTitle, string $commentBody, string $url)
    {
        return $this->sendToUser(
            $admin,
            'new_comment',
            'Comentariu nou de la ' . $commenterName . ' la "' . $videoTitle . '"',
            $commentBody,
            $url,
            ['video_title' => $videoTitle]
        );
    }
}
