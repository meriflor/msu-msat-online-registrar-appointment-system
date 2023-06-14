<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApprovedPaymentNotif extends Notification
{
    protected $remarks;
    protected $app_id;
    protected $notif_type;

    public function __construct($remarks, $app_id, $notif_type)
    {
        $this->remarks = $remarks;
        $this->app_id =  $app_id;
        $this->notif_type = $notif_type;
    }
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
            'remarks' => $this->remarks,
            'app_id' => $this->app_id,
            'notif_type' => $this->notif_type,
        ];
    }
}
