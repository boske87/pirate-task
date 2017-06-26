@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add job</div>
                    <div class="panel-body">
                        <h2>Add Job</h2>
                    </div>
                    <div class="links">
                        @include('partials.flash')
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
                        {!! Form::open(['route' => 'job.store']) !!}
                        <div class="form-group">
                            <label for="exampleInputTitle">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputTitle" aria-describedby="titleHelp" placeholder="Enter Title">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea">Description</label>
                            <textarea class="form-control" name="description" id="exampleTextarea" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection