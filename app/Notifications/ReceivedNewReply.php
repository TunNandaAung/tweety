<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReceivedNewReply extends Notification
{
    use Queueable;


    protected $subject;
    protected $reply;
    protected $isTweet;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $reply, $isTweet)
    {
        $this->subject = $subject;
        $this->reply = $reply;
        $this->isTweet = $isTweet;
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
            'notifier' => $this->reply->owner,
            'link' => $this->reply->path(),
            'description' => $this->reply->body,
        ];
    }

    public function message()
    {
        return sprintf('%s replied to your %s.', $this->reply->owner->name, $this->isTweet ? 'tweet' : 'reply');
    }
}
