<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Reply;

class TweetWasLiked extends Notification
{
    use Queueable;

    protected $subject;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $user)
    {
        $this->subject = $subject;
        $this->user = $user;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

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
            'description' => $this->subject->body,
        ];
    }

    public function message()
    {
        return sprintf('%s liked your %s', $this->user()->username, $this->subject instanceof Reply ? 'reply.' : 'tweet.');
    }

    /**
     * Get the associated user for the subject.
     */
    public function user()
    {
        return $this->user;
    }
}
