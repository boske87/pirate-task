@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All jobs</div>
                    <div class="panel-body">
                        <h2>All jobs</h2>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body">
                        @if($jobs->count())
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
                                @foreach($jobs as $job)
                                    <tr>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->description }}</td>
                                        <td>{{ $job->email }}</td>
                                        <td>{{ $job->publish == false ? 'No' : 'Yes'}}</td>
                                        <td>{{ $job->spam == false ? 'No' : 'Yes'}}</td>
                                    </tr>
                                @endforeach
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