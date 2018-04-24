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
                <h3 class="box-title">Assign Tasks</h3>
                <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
            </div>
            <input hidden name="shift_id" value="{{$shift->id}}">
            <form role="form" id="add-task" action="/schedules" method="post">
                {{ csrf_field() }}
                {{--@if(count($tasks)>0)--}}
                    @foreach($shift_employees as $employee)
                    <div class="form-check col-sm-6">
                        <span><i id="{{$employee->id}}" class="fa fa-plus"></i> </span>
                        {{--<input name="{{$employee->id}}" checked type="checkbox" class="form-check-input" value="">--}}
                        <label class="form-check-label"  for="{{$employee->id}}">{{$employee->name . ' '. $employee->surname}}</label>
                    </div>
                    @endforeach
                    {{--@else--}}
                    {{--<label>No Available tasks at the moment.</label>--}}
                {{--@endif--}}
                <div class="box-footer">
                    <center>
                        <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Next</button>
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
    </div>

@endsection
@push('datatable-scripts')
{{--<script--}}
{{--src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
{{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
{{--crossorigin="anonymous"></script>--}}
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        console.log("Checking here");
        $('#tasks_assign_modal').appendTo("body").modal();
        $('#yes').on('click',function(){
            window.location.href = '/home';
        });
        $('i').on('click',function(){
           alert($(this));
           console.log($(this));
        });
        $('#no').on('click',function(){
            $('#tasks_assign_modal').toggle('hide');
        });
    });
    function goBack(){
        window.history.back();
    }

</script>

@endpush()



