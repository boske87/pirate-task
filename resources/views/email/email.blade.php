<h1>Click the Link To Publish Job</h1>

Title: {{$title}}

Description: {{$description}}

Click the following link to verify your email {{url('/job/publish/'.$email_token.'?login_user='.$user) }}

<br>
<br>

Click the following link to make this job to be spam: {{url('/job/spam/'.$email_token.'?login_user='.$user) }}