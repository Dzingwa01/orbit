@extends('adminlte::layouts.app')
<?php
$team_members =App\TeamMember::join('users','users.id','team_members.team_member_id')
    ->join('teams','teams.id','team_members.member_team_id')
    ->select('users.*','team_members.member_team_id')
    ->get();
$team_members = $team_members->toArray();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@section('main-content')
    <div class="container-fluid" >

        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Add Shift</h3>
                <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
            </div>
            <form role="form" id="add-task" action="/schedules" method="post">
                {{ csrf_field() }}

                <div class="box-body">
                    <div class="row">
                        <input name="creator_id" type="number" value="{{Auth::user()->id}}" hidden>
                        <div class="col-md-6 form-group">
                            <label for="name">Shift Title</label>
                            <input id="shift_title" name="shift_title" class="form-control" placeholder="Shift Title" required>
                        </div>
                        <input hidden name="team_id" >

                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="shift_description">Shift Description</label>
                                <textarea id='shift_description' name="shift_description" class="form-control " required   placeholder="Shift Description" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="start_date">Start Date</label>
                                <input id='start_date' type='date' name="start_date" class="form-control"  placeholder="Start Date" required/>
                            </div>
                        </div>
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="end_date">End Date</label>
                                <input id='end_date' type='date' name="end_date" class="form-control "   placeholder="End Date" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="start_date">Start Time <sup>*24 hr notation</sup></label>
                                <input id='start_time' type='text' name="start_time" class="form-control"  placeholder="Start Time" required/>

                            </div>
                        </div>
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="end_date">End Time <sup>*24 hr notation</sup></label>
                                <input id='end_time' type='text' name="end_time" class="form-control"   placeholder="End Time" required />
                            </div>
                        </div>
                    </div>
                    <input id="sd"  name="shift_duration" hidden>
                    <div class="row">
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="end_date">Shift Duration - Hrs</label>
                                <input id='shift_duration' type='text' disabled="disabled" class="form-control"   placeholder="Daily Shift Duration" />
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="package_id">Assign Team</label>
                            <select id="team_id" name="team_id" class="form-control" required>
                                <option></option>
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}">{{$team->team_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="creator">Shift Creator</label>
                            <input class="form-control"  id="creator" value="{{Auth::user()->name . ' ' .Auth::user()->surname}}" disabled>
                        </div>
                    </div>

                <div id="dates_div">
                <table id="dates_table" class="table">
                    <thead id="headers">

                    </thead>
                    <tbody id="table_body">

                    </tbody>
                </table>
                </div>

                    <div class="box-footer">
                        <center>
                            <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Next</button>
                        </center>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection
@push('datatable-scripts')
    {{--<script--}}
            {{--src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
            {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
            {{--crossorigin="anonymous"></script>--}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#team_members').hide();
            $('#team_id').change(function(){
                $('#team_members').show();
                $('#team_members').empty();
                var current_team = $(this).val();
                $('#team_id').val(current_team);

                var team_members =[];
                team_members = {!! json_encode($team_members)!!}
                var counter = 0;
                if(team_members.length==0){
                    $("#team_members").append('<div><label>No Employees currently assigned to selected team<label></div>')
                }
                calculateDays(current_team);
            });
            $('select').select2({
                placeholder: 'Select or search an option'
            });
            $('#start_date').val(sessionStorage.getItem('start_date'));
            $('#end_date').val(sessionStorage.getItem('end_date'));

            $('#end_date').on('blur',function(){
                var isAfter = moment($('#end_date').val()).isAfter($('#start_date').val());
                console.log(isAfter);
                if(!isAfter){
                    alert('End date can not be less than start date');
                }
                if($("#team_id").val()!=""){
                    calculateDays($("#team_id").val());
                }
            });
        });

        function calculateDays(team_id){
            console.log('Check me');
            var date2 = moment($('#end_date').val(),'YYYY MM DD');
            var date1 = moment($('#start_date').val(),'YYYY MM DD');
            var diff = date2.diff(date1,'days');
            if(diff<=7){
                var datesArr = getDates(date1, date2);
                createTable(datesArr,team_id);
            }
            else{
                alert('Please split your shift weekly');
            }
           console.log(datesArr);
        }

        function getDates(startDate, endDate){
            var dates = [],
                currentDate = startDate,
                addDays = function(days) {
                    var date = new Date(this.valueOf());
                    date.setDate(date.getDate() + days);
                    return date;
                };
            while (currentDate <= endDate) {
                dates.push(currentDate);
                currentDate = addDays.call(currentDate, 1);
            }
            return dates;
        }
        function createTable (datesArr,team_id) {
            console.log('Drawing tables');
            $('#headers').empty();
            $('#table_body').empty();
            var tr_headers = '<tr><th>Employee</th>';
            for(var i=0;i<datesArr.length;i++){
                    tr_headers += '<th>'+moment(datesArr[i],'YYYY MM DD').date()+'/'+(moment(datesArr[i],'YYYY MM DD').month()+1)+'</th>';
            }
            tr_headers = tr_headers+'</tr>';
            $('#headers').append(tr_headers);
            var rows = '<tr>';
            var team_members =[];
            team_members = {!! json_encode($team_members)!!}
            var counter = 0;
            let team_employees_shifts = [];
            $.get('/team_employee_shifts/'+team_id,function(data){
                team_employees_shifts = data['employee_schedules'];
                console.log(team_employees_shifts);
                team_members.forEach(function(obj){
                    if(obj.member_team_id ==team_id){
                        rows += '<td>'+obj.name +' '+ obj.surname +'</td>';
                        for(var i=0;i<datesArr.length;i++){

                            var available = true;
                            for(var x=0;x<team_employees_shifts.length;x++){
                                var start_time = $("#start_time").val();
                                var end_time = $("#start_time").val();
                                if(team_employees_shifts[x].employee_id==obj.id&&moment(datesArr[i]).format('YYYY-MM-DD')==team_employees_shifts[x].shift_date && compareStartTime(team_employees_shifts[x].start_time,start_time,end_time,team_employees_shifts[x].end_time)){
                                    console.log("Hit",team_employees_shifts[x].shift_date);
                                    available = false;
                                }
                            }
                            if(available){
                                rows+='<td><input name="'+obj.id+'d'+moment(datesArr[i]).format('YYYY/MM/DD')+'" type="checkbox" class="form-check-input" checked value="'+obj.id+'"></td>';
                            }
                            else{
                                rows+='<td><input name="'+obj.id+'d'+moment(datesArr[i]).format('YYYY/MM/DD')+'" type="checkbox" class="form-check-input" disabled="disabled" value="'+obj.id+'"></td>';
                            }

                        }
                        rows += '</tr>';
                        $('#table_body').append(rows);
                        rows = '<tr>';
                    }
                });
            });
//            console.log(team_employees_shifts);

        }
        function compareStartTime(shift_start, starting_time,shift_ending_time,end_time){
            var hr = shift_start.split(':');
            var start_time = starting_time.split(':');
            var ending_time = end_time.split(':');
            var shift_end = shift_ending_time.split(':');
            console.log("hour",hr);
            console.log("start_time",start_time);
            console.log("ending_time",ending_time);
            var result =false;
            if(parseInt(hr[0])<=parseInt(start_time[0])){
                result = parseInt(hr[0])<=parseInt(start_time[0])&&parseInt(shift_end[0])<=parseInt(ending_time[0]);

            }
            else {
                result = parseInt(hr[0])>=parseInt(start_time[0])&&parseInt(shift_end[0])<=parseInt(ending_time[0]);
            }
            console.log(result);
            return result;
        }
        function goBack(){
            window.history.back();
        }
        $.noConflict();
        jQuery(function ($) {
            $('#start_time').timepicker({
                template: false,
                showInputs: true,
                minuteStep: 5,
                maxHours:24,
                showMeridian:false
            });
            $('#end_time').timepicker({
                template: false,
                showInputs: false,
                minuteStep: 5,
                maxHours:24,
                showMeridian:false
            });
            $("#end_time").on('blur',function(){

                var date1 = $('#start_time').val();
                var date2 = $('#end_time').val();
                var start = moment.utc(date1, "HH:mm");
                var end = moment.utc(date2, "HH:mm");
                if (end.isBefore(start))
                    end.add(1, 'day');
                var d = moment.duration(end.diff(start));
                var s = moment.utc(+d).format('H:mm');
                $('#shift_duration').val(s);
              $('#sd').val(s);
            });
        });
    </script>

@endpush()



