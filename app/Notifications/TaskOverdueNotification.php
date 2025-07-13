<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskOverdueNotification extends Notification
{
    use Queueable;
    private Task $task;
    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        //
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Tarea vencida: ' . $this->task->title)
            ->line('La siguiente tarea ha vencido:')
            ->line('Título: ' . $this->task->title)
            ->line('Fecha de vencimiento: ' . $this->task->due_date)
            ->line('Por favor, revisa esta tarea lo antes posible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
