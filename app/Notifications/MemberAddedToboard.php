<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\User;
use App\Board;

class MemberAddedToboard extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $board;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,Board $board)
    {
        $this->user=$user;
        $this->board=$board;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [

          'user_id'=>$this->user->id,
          'user_name'=>$this->user->name,

          'board_id'=>$this->board->id_board,
          'board_titre'=>$this->board->titre,
          'message'=>$this->user->name.' vous ajouté au board '.$this->board->titre

        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return (new BroadcastMessage([

             'user_id'=>$this->user->id,
             'user_name'=>$this->user->name,

             'board_id'=>$this->board->id_board,
             'board_titre'=>$this->board->titre,
             'message'=>$this->user->name.' vous ajouté au board '.$this->board->titre

        ]));
    }
}
