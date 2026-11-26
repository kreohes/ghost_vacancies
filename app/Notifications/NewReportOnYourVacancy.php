<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReportOnYourVacancy extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Report $report) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $vacancy = $this->report->vacancy;

        $mail = (new MailMessage)
            ->subject('New report on '.$vacancy->title)
            ->greeting('Hi '.$notifiable->name.'!')
            ->line('Someone who applied to '.$vacancy->title.' at '.$vacancy->company->name.' reported: '.$this->report->status.'.');

        if ($this->report->comment) {
            $mail->line('Their comment: "'.$this->report->comment.'"');
        }

        return $mail
            ->line('The ghost risk of this vacancy is now: '.$vacancy->riskLabel().'.')
            ->action('See the vacancy', route('vacancies.show', $vacancy))
            ->salutation('Thanks for adding the vacancy. Ghost Vacancies');
    }
}
