@extends('adminlte::layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@section('main-content')
    <div class="container-fluid" >

        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Assign Tasks</h3>
                <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
            </div>
            <input hidden name="shift_id" value="{{$shift->id}}">
            <form role="form" id="add-task" >
                {{ csrf_field() }}

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
                        <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Finish</button>
                    </center>
                </div>
            </form>
        </div>
        <div id="tasks_assign_modal" class="modal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Assign Tasks</h4>
                    </div>
                    <div class="modal-body">
                        <p>Would you like to assign tasks to this shift?</p>
                    </div>
                    <div class="modal-footer">
                        <button id="yes" type="button" class="btn btn-success" data-dismiss="modal">Yes</button>
                        <button id="no" type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                </div>

            </div>
        </div>
        <div id="tasks_modal" class="modal">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Assign Tasks to <span id="name"></span> </h4>
                    </div>
                    <div class="modal-body">
                        @if(count($tasks)>0)
                        <form id="tasks" method="post">
                            <button id="new_task_btn" type="button" class="btn btn-primary" >New Task</button>
                            <fieldset><legend>Select existing tasks</legend>
                            {{ csrf_field() }}
                        <div >
                            @foreach($tasks as $task)
                                <input name="{{$task->id}}" type="checkbox" class="form-check-input" value="{{$task->id}}">
                                <label class="form-check-label"  for="{{$task->id}}">{{$task->name . ' - '. $task->description}}</label>
                            @endforeach
                        </div>
                            <input id="" name="shift_id" type="number" value="{{$shift->id}}" hidden>
                            <input hidden name="employee_id" id="employee_id" >
                            <input  type="submit" class="btn btn-success" value="Save">
                            <button id="cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </fieldset>
                        </form>
                            <form id ="new_task_from_existing" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input name="creator_id" type="number" value="{{Auth::user()->id}}" hidden>
                                    <input id="selected_employee_id" name="employee_id" type="number" value="" hidden>
                                    <input id="" name="shift_id" type="number" value="{{$shift->id}}" hidden>
                                    <div class="col-md-6 form-group">
                                        <label for="name">Task Title</label>
                                        <input id="name"  type="text" name="name" class="form-control" placeholder="Task Title">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="description">Task Description</label>
                                        <textarea id="description" name="description" class="form-control" type="text"></textarea>
                                    </div>
                                    {{--<div class="col-md-6 form-group">--}}
                                    {{--<label for="creator">Task Creator</label>--}}
                                    {{--<input class="form-control"  id="creator" value="{{Auth::user()->name . ' ' .Auth::user()->surname}}" disabled>--}}
                                    {{--</div>--}}
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
                                            <input id='end_date' type='date' name="end_date" class="form-control"   placeholder="End Date" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-sm-6 form-group'>
                                        <div class="form-group">
                                            <label class="control-label" for="start_time">Start Time <sup>*24 hr notation</sup></label>
                                            <input id='start_time' type='text' name="start_time" class="form-control"  placeholder="Start Time" required/>

                                        </div>
                                    </div>
                                    <div class='col-sm-6 form-group'>
                                        <div class="form-group">
                                            <label class="control-label" for="end_time">End Time <sup>*24 hr notation</sup></label>
                                            <input id='end_time' type='text' name="end_time" class="form-control"   placeholder="End Time" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label for="picture_url">Picture</label>
                                        <input type="file" class="form-control">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success" value="Save">
                                <button id="cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </form>
                        @else
                            <label>No tasks available for this shift. Add task below</label>

                            <form id ="new_task" method="post">
                                {{ csrf_field() }}
                            <div class="row">
                                <input name="creator_id" type="number" value="{{Auth::user()->id}}" hidden>
                                <input id="selected_employee_id" name="employee_id" type="number" value="" hidden>
                                <input id="" name="shift_id" type="number" value="{{$shift->id}}" hidden>
                                <div class="col-md-6 form-group">
                                    <label for="name">Task Title</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Task Title">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="description">Task Description</label>
                                    <textarea id="description" name="description" class="form-control" type="text"></textarea>
                                </div>
                                {{--<div class="col-md-6 form-group">--}}
                                    {{--<label for="creator">Task Creator</label>--}}
                                    {{--<input class="form-control"  id="creator" value="{{Auth::user()->name . ' ' .Auth::user()->surname}}" disabled>--}}
                                {{--</div>--}}
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
                                        <input id='end_date' type='date' name="end_date" class="form-control"   placeholder="End Date" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-6 form-group'>
                                    <div class="form-group">
                                        <label class="control-label" for="start_time">Start Time <sup>*24 hr notation</sup></label>
                                        <input id='start_time' type='text' name="start_time" class="form-control"  placeholder="Start Time" required/>

                                    </div>
                                </div>
                                <div class='col-sm-6 form-group'>
                                    <div class="form-group">
                                        <label class="control-label" for="end_time">End Time <sup>*24 hr notation</sup></label>
                                        <input id='end_time' type='text' name="end_time" class="form-control"   placeholder="End Time" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="picture_url">Picture</label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                                <input  type="submit" class="btn btn-success" value="Save">
                                <button id="cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </form>

                        @endif
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('datatable-scripts')

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#new_task_from_existing").hide();
        $('#tasks_assign_modal').appendTo("body").modal();
        $('#no').on('click',function(){
            window.location.href = '/home';
        });

        $("#new_task_btn").on('click',function () {
            $("#tasks").hide();
            $("#new_task_from_existing").show();
            $.get('/get_employee_name/'+$("#employee_id").val(),function(data){
                $("#name").empty();
                $("#name").append(data);
            });
//            $('#start_date').val(shift_date);
//            $('#end_date').val(shift_date);
//            $('#selected_employee_id').val($("#employee_id"));
            $('#selected_employee_id').val($("#employee_id").val());
            $('#tasks_modal').appendTo("body").modal();
        });

        $('#yes').on('click',function(){
            $('#tasks_assign_modal').toggle('hide');
            calculateDays();
        });
        $('#new_task').submit(function(e){
           e.preventDefault();
           $.post("/shift_tasks",$('#new_task').serialize()).done(function(){
               $("input[type=text], textarea").val("");
              $('#tasks_modal').modal('hide');
           });
        });

        $('#new_task_from_existing').submit(function(e){
            e.preventDefault();
            $.post("/shift_tasks",$('#new_task_from_existing').serialize()).done(function(){
                $("input[type=text], textarea").val("");
                $("#new_task_from_existing").hide();
                $("#tasks").show();
                $('#tasks_modal').modal('hide');
            });
        });
        $('#tasks').submit(function(e){
            e.preventDefault();
            $.post("/another_shift_tasks",$('#tasks').serialize()).done(function(){
                $('#tasks_modal').modal('hide');
            });
        });
        $('#start_time').timepicker({
            template: false,
            showInputs: true,
            minuteStep: 5,
            maxHours: 24,
            showMeridian: false
        });
        $('#end_time').timepicker({
            template: false,
            showInputs: false,
            minuteStep: 5,
            maxHours: 24,
            showMeridian: false
        });
//        $('a').click(function(event){
//            console.log("clicked");
//            $.get('/get_employee_name/'+event.target.id,function(data){
//                $("#name").empty();
//                $("#name").append(data);
//            });
//            $('#employee_id').val(event.target.id);
//            $('#selected_employee_id').val(event.target.id);
//            $('#tasks_modal').appendTo("body").modal();
//
//        });
        function calculateDays(){
            console.log('Check me');
            var shift = {!! json_encode($shift) !!}
                console.log("Shift",shift);
                var team = {!! json_encode($team)!!}
                console.log("team",team);
            var date2 = moment(shift.start_date,'YYYY MM DD');
            var date1 = moment(shift.end_date,'YYYY MM DD');
            var diff = date1.diff(date2,'days');
            console.log("Diiff",diff);
            if(diff<=7){
                var datesArr = getDates(date2, date1);
                console.log("dates Array",datesArr);
                createTable(datesArr,team);
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
                dates.push(moment(currentDate).format("YYYY-MM-DD"));
                currentDate = addDays.call(currentDate, 1);
            }
            return dates;
        }
        function createTable (datesArr,team) {
            console.log('Drawing tables');
            $('#headers').empty();
            $('#table_body').empty();
            var tr_headers = '<tr><th>Employee</th>';
            for(var i=0;i<datesArr.length;i++){
                tr_headers += '<th>'+moment(datesArr[i],'YYYY MM DD').date()+'/'+(moment(datesArr[i],'YYYY MM DD').month()+1)+'</th>';
            }
            tr_headers = tr_headers+'</tr>';
            console.log("headers",tr_headers);

            $('#headers').append(tr_headers);
            var rows = '<tr>';
            var team_members =[];
            team_members = {!! json_encode($shift_employees) !!};
            var counter = 0;
            let team_employees_shifts = [];
            $.get('/team_employee_shifts/'+team.id,function(data){
                team_employees_shifts = data['employee_schedules'];
                console.log("team_emp_shifts",team_employees_shifts);
                console.log("team members",team_members);
                team_members.forEach(function(obj){
                        rows += '<td>'+obj.name +' '+ obj.surname +'</td>';
                        for(var i=0;i<datesArr.length;i++){
                            var cur_date = moment(datesArr[i]).format("YYYY-MM-DD");
                            var available = false;
                            for(var x=0;x<team_employees_shifts.length;x++){
                                var start_time = $("#start_time").val();
                                if(team_employees_shifts[x].employee_id==obj.id&&moment(datesArr[i]).format('YYYY-MM-DD')==team_employees_shifts[x].shift_date){
                                    available = true;
                                }
                            }
                            if(available){
                                console.log("Check here",cur_date);
                                var id_string = obj.id+","+cur_date;
                                rows+='<td><a id="'+id_string+'" onclick="assign_task(this)"><i   class="fa fa-plus task_add"></i></a></td>';
                            }
                            else{
                                rows+='<td><a onclick="no_shift()"><i class="fa fa-minus task_add"></i></a></td>';
                            }
                        }
                        rows += '</tr>';
                        $('#table_body').append(rows);
                        rows = '<tr>';

                });
            });
        }
    });
    function no_shift(){
        alert("Employee is not working on this day");
    }
    function assign_task(obj){
//        console.log("Shift_date",obj.id);
        $("#new_task_from_existing").hide();
        $("#tasks").show();
        var arr_values = obj.id.split(',');
        var id = arr_values[0];
        var shift_date = arr_values[1];
        $.get('/get_employee_name/'+id,function(data){
            $("#name").empty();
            $("#name").append(data);
        });
        $('#start_date').val(shift_date);
        $('#end_date').val(shift_date);
        $('#employee_id').val(id);
        $('#selected_employee_id').val(id);
        $('#tasks_modal').appendTo("body").modal();
    }
    function goBack(){
        window.history.back();
    }
    function compareStartTime(shift_start, starting_time,end_time){
        var hr = shift_start.split(':');
        var start_time = starting_time.split(':');
        var ending_time = end_time.split(':');
        var result = parseInt(hr[0])<=parseInt(start_time[0])&&parseInt(hr[0])<=parseInt(ending_time[0]);
        console.log(result);
        return result;
    }
</script>

@endpush()



