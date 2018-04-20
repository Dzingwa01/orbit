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
                <h3 class="box-title">Assign Dates</h3>
                <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
            </div>
            <form role="form" id="add-task" action="/schedules" method="post">
                {{ csrf_field() }}


                <div class="box-footer">
                    <center>
                        <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Next</button>
                    </center>
                </div>
            </form>
            {{--<form id="add-team-members" action="/manager_update_team_members" method="post">--}}
            {{--{{ csrf_field() }}--}}
            {{--<legend>Team Members</legend>--}}
            {{--<input hidden name="team_id" value="{{$team->id}}">--}}
            {{--<fieldset>--}}
            {{----}}
            {{--</form>--}}
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

    });
    function goBack(){
        window.history.back();
    }

</script>

@endpush()



