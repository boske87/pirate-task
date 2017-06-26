<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailPublish;

class SendPublishEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $jobProject;
    protected $jobBoardModerators;

    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($jobProject, $jobBoardModerators)
    {
        $this->jobProject = $jobProject;
        $this->jobBoardModerators = $jobBoardModerators;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->jobBoardModerators as $moderator) {
            $email = new EmailPublish($this->jobProject, $moderator->id);
            Mail::to($moderator->email)->send($email);
        }
    }
}
