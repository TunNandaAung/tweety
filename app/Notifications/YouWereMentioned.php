<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Reply;

class YouWereMentioned extends Notification
{
    use Queueable;

    protected $subject;

    /**
     * Create a new notification instance.
     *
     * @param $subject
     */
    public function __construct($subject)
    {
        $this->subject = $subject;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message(),
            'notifier' => $this->user(),
            'link' => $this->subject->path(),
        ];
    }

    public function message()
    {
        return sprintf('%s mentioned you in %s', $this->user()->username, $this->subject instanceof Reply ? 'a reply.' : 'in a tweet.');
    }

    /**
     * Get the associated user for the subject.
     */
    public function user()
    {
        return $this->subject instanceof Reply ? $this->subject->owner : $this->subject->user;
    }
}
