<?php

namespace App\Notifications;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminderNotification extends Notification
{
    use Queueable;

    private $event;

    /**
     * Create a new notification instance.
     *
     * @param $event
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(trans('panel.site_title'))
                    ->line('不到一個小時就為你安排了一個活動')
                    ->line('標題：' . $this->event->title)
                    ->line('描述：' . $this->event->description)
                    ->line('開始時間：' . $this->event->start_time . ' (' . $this->event->timezone . ')');
    }
}
