@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-10 col-sm-12"  style="display: block;">
            <h3>Team Schedule Summary</h3>
            {{--<a id="create_shift" class="btn btn-primary">Create Shift</a>--}}
            <a id="my_shifts"  class="btn btn-primary">My Shifts</a>
            <div id='calendar' >  {!! $calendar->calendar() !!}</div>
        </div>
    </div>

@endsection
@push('datatable-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <script type="text/javascript">
        {{--$(document).ready(function ($) {--}}
            {{--$("#create_shift").on('click',function () {--}}
                {{--var counter = {{$employees_count}}--}}
                {{--if(counter == 0){--}}
                    {{--$.notify("You currently do not have any employees, please add employees before creating a shift", "warning");--}}
                {{--}--}}
                {{--else{--}}
                    {{--window.location.href = 'schedules/create';--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

    </script>
    {!! $calendar->script() !!}

@endpush