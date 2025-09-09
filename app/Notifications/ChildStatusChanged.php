<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ChildStatusChanged extends Notification
{
    use Queueable;

    protected $child;
    protected $action;

    public function __construct($child, $action)
    {
        $this->child = $child;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'child_id'   => $this->child->child_id,
            'child_name' => trim(($this->child->child_first_name ?? '') . ' ' . ($this->child->child_last_name ?? '')),
            'action'     => $this->action,
            'by_user'    => auth()->user()->user_name ?? 'System',
            'center_id'  => $this->child->center_id,
            'detailUrl' => url('/current-child-masters/'.$this->child->child_id),
            'center_name'=> $this->child->center->center_name ?? 'N/A',
        ];
    }
    
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('Child Status Updated')
    //         ->greeting('Hello ' . ($notifiable->user_name ?? 'Admin'))
    //         ->line('The child "' . $this->child->child_first_name . ' ' . $this->child->child_last_name . '" has been ' . $this->action . '.')
    //         ->action('View Child Details', url('/current-child-masters/' . $this->child->child_id))
    //         ->line('Thank you for using our application!');
    // }


    //new tempalet with QR 
    
    public function toMail($notifiable)
        {
            return (new MailMessage)
                ->subject("{$this->action} - Child: {$this->child->child_first_name} {$this->child->child_last_name}")
                ->view('emails.child_status_changed_unique', [
                    'child'     => $this->child,
                    'action'    => $this->action,
                    'detailUrl' => url('/current-child-masters/'.$this->child->child_id),
                    'qrCodeUrl' => 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' 
                                    . urlencode(url('/current-child-masters/'.$this->child->child_id)),
                ]);
        }

 }
