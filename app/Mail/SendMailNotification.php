<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $jobProject;
    protected $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($jobProject, $msg)
    {
        $this->jobProject = $jobProject;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.notification')->with([
            'title' => $this->jobProject->title,
            'description' => $this->jobProject->description,
            'msg' => $this->msg,
        ]);
    }
}
