@extends('adminlte::layouts.app')
<?php
$team_members_shift =App\TeamMember::join('users','users.id','team_members.team_member_id')
    ->join('teams','teams.id','team_members.member_team_id')
    ->select('users.*','team_members.member_team_id')
    ->get();
$team_members_shift = $team_members_shift->toArray();
?>
@section('main-content')
    <div class="container-fluid" >

        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Edit Shift Details</h3>
                <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
            </div>
            <form role="form" id="add-task" action="/update_shift/{{$shift->id}}" method="post">
                {{ csrf_field() }}
                <input hidden name="team_id" value="{{$shift->id}}">
                <div class="box-body">
                    <div class="row">
                        <input name="creator_id" type="number" value="{{Auth::user()->id}}" hidden>
                        <div class="col-md-6 form-group">
                            <label for="name">Shift Title</label>
                            <input id="shift_title" name="shift_title" class="form-control" required placeholder="Shift Title" value="{{$shift->shift_title}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="creator">Task Creator</label>
                            <input class="form-control"  id="creator" value="{{Auth::user()->name . ' ' .Auth::user()->surname}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        {{--<div class="col-md-6 form-group">--}}
                            {{--<label for="start_date">Start Date</label>--}}
                            {{--<input type="date" name="start_date" class="form-control" class="date" class="form-control"  value="{{$shift->start_date}}"/>--}}
                        {{--</div>--}}
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="start_date">Start Date</label>
                                    <input id='start_date' type='text' name="start_date" class="form-control" required value="{{$shift->start_date}}"/>

                            </div>
                        </div>
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="end_date">End Date</label>
                                <input id='end_date' type='text' name="end_date" class="form-control" value="{{$shift->end_date}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="end_date">Daily Shift Duration</label>
                                <input id='shift_duration' type='number' name="shift_duration" class="form-control" value="{{$shift->duration}}" required placeholder="Daily Shift Duration" />
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="package_id">Team</label>
                            <select id="team_id" name="team_id" class="form-control" required>
                                <option></option>
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}" {{$shift->team_id==$team->id?'selected':''}}>{{$team->team_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label id="existing_label">Current Team Members</label>
                   <div class="row" id="existing_members">

                            {{--<input hidden name="team_id" value="{{$team->id}}">--}}
                            {{--<fieldset>--}}
                            @foreach($team_members as $team_member)
                                <div class="form-check col-sm-6">
                                    <input name="{{$team_member->contact_number}}" checked type="checkbox" class="form-check-input" value="{{$team_member->id}}">
                                    <label class="form-check-label"  for="{{$team_member->contact_number}}">{{$team_member->name . ' '. $team_member->surname}}</label>
                                </div>
                            @endforeach
                        </div>
                    <label id="selected_team" hidden>Selected Team Employees</label>
                    <div id="team_members" class="row" hidden>



                    </div>

                </div>
                <div class="box-footer">
                    <center>
                        <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Update</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.14/jquery.datetimepicker.full.min.js"></script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#team_members').hide();
            $('#team_id').change(function(){
                $('#team_members').show();
                $('#team_members').empty();
                var current_team = $(this).val();
                $('#team_id').val(current_team);

                var team_members =[];
                team_members = {!! json_encode($team_members_shift)!!}
                    console.log(team_members);
                var counter = 0;
                team_members.forEach(function(obj){
                    if(obj.member_team_id ==current_team){
                        counter++;console.log("get");
                        $('#team_members').append('<div class="form-check col-sm-6">\n' +
                            '                            <input name="'+obj.contact_number+'" type="checkbox" class="form-check-input" checked value="'+obj.id+'">\n' +
                            '                            <label class="form-check-label" for="'+obj.contact_number+'" >'+obj.name+' '+ obj.surname+'</label>\n' +
                            '                        </div>');

                    }
                });
                if(counter==0){
                    $("#team_members").append('<div><label>No Employees currently assigned to selected team<label></div>');
                    $('#existing_members').show();
                    $('#existing_label').show();
                    $('#selected_team').hide();
                }
                else{
                    $('#existing_members').hide();
                    $('#existing_label').hide();
                    $('#selected_team').show();
                }
            });
            $('select').select2({
                placeholder: 'Select or search an option'
            });


        });
//        var gt = $.noConflict();
        jQuery(function ($) {
            $('#start_date').datetimepicker();
            $('#end_date').datetimepicker();
        });
//        $('#start_date').datetimepicker('show');

        //        jQuery.datetimepicker.setLocale('en');
        function goBack(){
            window.history.back();
        }
    </script>

@endpush()



