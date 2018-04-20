@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
<?php
$tasks = App\Task::where('users.creator_id',Auth::user()->id);
$employees_count = count(DB::table('users')
    ->join('packages','packages.id','users.package_id')
    ->where('users.creator_id',Auth::user()->id)
    ->select('users.*','packages.package_name')->get());
$shifts = App\Shift::where('creator_id',Auth::user()->id)->get();
$events = [];
foreach ($shifts as $shift){
    $event = new stdClass();
    $event->title = $shift->shift_title;
    $event->start = $shift->start_date;
    $event->end = $shift->end_date;
    $event->url = 'shifts/'.$shift->id;
    array_push($events,$event);

}
$events = json_encode($events);
//dd($events);
?>
@section('style')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-10 col-sm-12"  style="display: block;">
            <h3>Team Schedule Summary</h3>
            <a id="create_shift" class="btn btn-primary">Create Shift</a>
            <a id="my_shifts" href="{{url('shifts')}}" class="btn btn-primary">My Shifts</a>
        <div id='calendar' >  </div>
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
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <script type="text/javascript">
//        $.noConflict();
        $(document).ready(function ($) {
           $("#create_shift").on('click',function () {
               var counter = {{$employees_count}}
               if(counter == 0){
                   $.notify("You currently do not have any employees, please add employees before creating a shift", "warning");
               }
               else{
                   {{--{{return view('schedules.create',compact('startDate'))}}--}}
                   sessionStorage.setItem('start_date',formatDate(new Date()));
                   sessionStorage.setItem('end_date',formatDate(new Date()));
                   window.location.href = 'schedules/create';
               }
           });
           var events = [];
           events = {!! $events !!}
           console.log(events);
            $('#calendar').fullCalendar({
                selectable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events:events,
                dayClick: function(date) {
//                    alert('clicked ' + date.format());
                },
                select: function(startDate, endDate) {
//                    alert('selected ' + startDate.format() + ' to ' + endDate.format());
                    var counter = {{$employees_count}}
                    if(counter == 0){
                        $.notify("You currently do not have any employees, please add employees before creating a shift", "warning");
                    }
                    else{
                        {{--{{return view('schedules.create',compact('startDate'))}}--}}
                            sessionStorage.setItem('start_date',startDate.format());
                            sessionStorage.setItem('end_date',endDate.format());
                        window.location.href = 'schedules/create';
                    }
                },
                allDay:false,
                timeFormat: 'H(:mm)',
                eventColor: '#f96332'
            });
            $('#end_date').on('blur',function(){
                var start_date = moment($('#start_date').val());
//                var end_date = moment($('#end_date').val());

            });
        });
function formatDate(date) {
    var monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
    ];

    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    return year+'-'+monthNames[monthIndex]+'-'+day;
}

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
    {{--{!! $calendar->script() !!}--}}

@endpush