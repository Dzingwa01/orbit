@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
<?php
$tasks = App\Task::all();
?>
@section('style')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-10 col-sm-12"  style="display: block;">
            <h3>Team Schedule Summary</h3>
            <a id="create_shift" href="{{url('schedules/create')}}" class="btn btn-primary">Create Shift</a>
            <a id="create_shift" href="{{url('shifts')}}" class="btn btn-primary">My Shifts</a>
        <div id='calendar' >  {!! $calendar->calendar() !!}</div>
        </div>
    </div>

    {{--<div id="create_team_modal" role="dialog" class="modal fade" style="display: block; margin-top: 5em;" >--}}
        {{--<div class="modal-dialog">--}}
            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>--}}
                    {{--<h4 class="modal-title">Welcome to Orbit {{Auth::user()->name . " " .Auth::user()->surname}}. </h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<p>Your package allows for team members. Do you want to create your team now.</p>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button id="not_now" type="button" class="btn btn-default pull-left" data-dismiss="create_team_modal">Not Now--}}
                    {{--</button>--}}
                    {{--<button id="create_team" type="button" class="btn btn-success">Create Team</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
@endsection

@push('datatable-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {{--<script type="text/javascript">--}}
       {{--var conf = jQuery.noConflict();--}}
    {{--</script>--}}
    {{--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>--}}

    <script type="text/javascript">
        {{--var holder = $.noConflict();--}}
        {{--holder(document).ready(function () {--}}
            {{--console.log('tapinda');--}}
            {{--var logins_counter = 0;--}}
            {{--logins_counter =--}}
            {{--{{Auth::user()->logins_counter}}--}}
            {{--if (logins_counter == 0) {--}}
                {{--holder('#create_team_modal').modal('show');--}}
            {{--}--}}
            {{--else {--}}
                {{--holder('#create_team_modal').modal('hide');--}}

            {{--}--}}

            {{--holder('#not_now').on('click', function () {--}}
                {{--holder('#create_team_modal').modal('hide');--}}
                {{--{{Auth::user()->update(array('logins_counter' => 1))}}--}}
            {{--});--}}
            {{--holder('#create_team').on('click', function () {--}}
                {{--alert('Clicked');--}}
            {{--});--}}
        {{--});--}}

            {{--holder('#calendar').fullCalendar({--}}
                {{--// put your options and callbacks here--}}
                {{--events : [--}}
                {{--@foreach($tasks as $task)--}}
                {{--{--}}
                {{--title : '{{ $task->name }}',--}}
                {{--start : '{{ $task->task_date }}',--}}
                {{--url : '{{ route('tasks.edit', $task->id) }}'--}}
                {{--},--}}
                {{--@endforeach--}}
                {{--]--}}
                {{--});--}}

//        });


    </script>
    {!! $calendar->script() !!}

@endpush