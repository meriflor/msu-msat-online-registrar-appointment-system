<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppRemarksUpdate extends Notification
{
    protected $remarks;
    protected $app_id;
    protected $notif_type;
    protected $title;
    protected $doc;
    protected $resched;
    public function __construct($remarks, $app_id, $notif_type, $title, $doc, $resched)
    {
        $this->remarks = $remarks;
        $this->app_id =  $app_id;
        $this->notif_type = $notif_type;
        $this->title = $title;
        $this->doc = $doc;
        $this->resched = $resched;
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
            'title' => $this->title,
            'doc' => $this->doc,
            'resched' => $this->resched,
        ];
    }
}
