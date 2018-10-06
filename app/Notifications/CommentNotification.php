<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Comment;

class CommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
         * Comment property.
         *
         * @var \App\Comment
         */
    protected $comment;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment=$comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
          'comment_user'=>$this->comment->user->name,
          'comment_id' => $this->comment->id_comment,
          'comment_message' => $this->comment->commentaire,
        ];
    }
}
