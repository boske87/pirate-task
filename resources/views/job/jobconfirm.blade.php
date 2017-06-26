@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All jobs</div>
                    <div class="panel-body">
                        <h2>Publish job</h2>
                    </div>
                    <div class="links">
                        @if($msg)
                            <section class="content-header">
                                <div class="alert alert-{{ $msg['flash_message_type'] }} alert-dismissable">
                                    <p>{{ $msg['flash_message'] }}</p>
                                </div>
                            </section>
                        @endif
                    </div>
                    <div class="panel-body">
                        @if($job)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>Title</td>
                                    <td>Description</td>
                                    <td>Email</td>
                                    <td>Publish</td>
                                    <td>Spam</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->description }}</td>
                                        <td>{{ $job->email }}</td>
                                        <td>{{ $job->publish == false ? 'No' : 'Yes'}}</td>
                                        <td>{{ $job->spam == false ? 'No' : 'Yes'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p>No job offers.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection