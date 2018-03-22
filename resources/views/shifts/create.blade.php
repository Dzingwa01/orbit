@extends('adminlte::layouts.app')
<?php
$team_members =App\TeamMember::join('users','users.id','team_members.team_member_id')
    ->join('teams','teams.id','team_members.member_team_id')
    ->select('users.*','team_members.member_team_id')
    ->get();
$team_members = $team_members->toArray();
?>
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
                            <input id="shift_title" name="shift_title" class="form-control" placeholder="Shift Title">
                        </div>
                        <input hidden name="team_id" >
                        <div class="col-md-6 form-group">
                            <label for="creator">Task Creator</label>
                            <input class="form-control"  id="creator" value="{{Auth::user()->name . ' ' .Auth::user()->surname}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="start_date">Start Date</label>
                                <input id='start_date' type='text' name="start_date" class="form-control"  placeholder="Start Date"/>

                            </div>
                        </div>
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="end_date">End Date</label>
                                <input id='end_date' type='text' name="end_date" class="form-control"   placeholder="End Date" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                <div id="team_members" class="row" hidden>

                </div>

                    <div class="box-footer">
                        <center>
                            <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save</button>
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
                team_members.forEach(function(obj){
                   if(obj.member_team_id ==current_team){
                       counter++;
                       $('#team_members').append('<div class="form-check col-sm-6">\n' +
                           '                            <input name="'+obj.contact_number+'" type="checkbox" class="form-check-input" checked value="'+obj.id+'">\n' +
                           '                            <label class="form-check-label" for="'+obj.contact_number+'" >'+obj.name+' '+ obj.surname+'</label>\n' +
                           '                        </div>');

                   }
                });
                if(counter==0){
                    $("#team_members").append('<div><label>No Employees currently assigned to selected team<label></div>')
                }
            });
            $('select').select2({
                placeholder: 'Select or search an option'
            });

        });
        function goBack(){
            window.history.back();
        }
        jQuery(function ($) {
            $('#start_date').datetimepicker();
            $('#end_date').datetimepicker();
        });
    </script>

@endpush()



