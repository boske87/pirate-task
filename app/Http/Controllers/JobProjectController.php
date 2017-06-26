<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddJobRequest;
use App\JobProject;
use App\Jobs\SendNotificationEmail;
use App\Jobs\SendPublishEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobProjectController extends Controller
{

    /**
     * Resource
     */

    public function index()
    {
        $jobs = JobProject::all();

        return view('job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AddJobRequest $request)
    {
        $job = new JobProject();
        $job->title = $request->get('title');
        $job->email = $request->get('email');
        $job->description = $request->get('description');
        $job->user_id = $request->user()->id;
        $job->email_token = base64_encode($job->email);
        if(!Auth::user()->checkIfFirstPosting($job->email)) {
            $job->publish = true;
            $messageAddition = 'This post will be published automatically, because you already have published posts with this email.';

        } else {
            $messageAddition = 'This is your first job posting for this email and it needs to be approved by Job board moderator.';
        }
        $job->save();

        //send mail to user ho add new job
        dispatch(new SendNotificationEmail($job, $messageAddition));

        // get all Job board moderators
        $jobBoardModerators = User::getJobBoardModerators();

        //send email to moderator to publish
        if($job->publish == false) {
            dispatch(new SendPublishEmail($job, $jobBoardModerators));
        }

        if($job) {
            $message = [
                'flash_message' => 'Post has been created. ' . $messageAddition,
                'flash_message_type' => 'success'
            ];
        } else {
            $message = [
                'flash_message' => 'Post has not been created.',
                'flash_message_type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);

    }

    public function publish($token)
    {
        $job = JobProject::where('email_token', $token)->first();
        if($job->publish == true) {
            $message = [
                'flash_message' => 'You already publish this job',
                'flash_message_type' => 'danger'
            ];
            return view('job.jobconfirm', ['job' => $job, 'msg' =>$message]);
        } else {
            $job->publish = true;
            if ($job->save()) {
                $message = [
                    'flash_message' => 'You have successfully publish this job.',
                    'flash_message_type' => 'success'
                ];
                return view('job.jobconfirm', ['job' => $job, 'msg' =>$message]);
            }
        }
    }

    public function spam($token)
    {
        $job = JobProject::where('email_token', $token)->first();
        if($job->spam == true) {
            $message = [
                'flash_message' => 'You already set this job to spam',
                'flash_message_type' => 'danger'
            ];
            return view('job.jobconfirm', ['job' => $job, 'msg' =>$message]);
        } else {
            $job->spam = true;
            if ($job->save()) {
                $message = [
                    'flash_message' => 'You have successfully set this job to spam',
                    'flash_message_type' => 'success'
                ];
                return view('job.jobconfirm', ['job' => $job, 'msg' =>$message]);
            }
        }
    }
}
