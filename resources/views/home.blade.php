@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="links">
                    @include('partials.flash')
                </div>
                @if(Auth::check())
                    @if(Auth::user()->hasRole('manager'))
                        <div class="panel-body">
                            <a href="{{route('job.create')}}">Add job</a>
                        </div>
                    @endif
                    @if(Auth::user()->hasRole('moderator'))
                            <div class="panel-body">
                                <a href="{{ url('job') }}">All job offers</a>
                            </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
