<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $activityName;
    public $date;
    public $startTime;
    public $endTime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $activityName, $date, $startTime, $endTime)
    {
        $this->userName = $userName;
        $this->activityName = $activityName;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.appointments.confirmation');
    }
}
