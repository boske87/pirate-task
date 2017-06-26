<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPublish extends Mailable
{


    use Queueable, SerializesModels;

    protected $jobProject;
    protected $moderatorId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($jobProject, $moderatorId)
    {
        $this->jobProject = $jobProject;
        $this->moderatorId = $moderatorId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email')->with([
            'title' => $this->jobProject->title,
            'description' => $this->jobProject->description,
            'email_token' => $this->jobProject->email_token,
            'user' => $this->moderatorId
        ]);
    }
}
