@extends('adminlte::layouts.app')
<?php
    $employees =\App\User::where('creator_id',Auth::user()->id)->get();
?>
@section('main-content')
    <div class="container-fluid" >
        {{--<div class="col-md-10">--}}
        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Add Team Members: {{$team->team_name}}</h3>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-sm-2">--}}
                    {{--<button id="email_invite" class="btn btn-success"><i class="fa fa-mail-forward"></i>Invite by Email</button>--}}
                {{--</div>--}}
                {{--@if(count($employees)==0)--}}
                {{--<div class="col-sm-2">--}}
                    {{--<span>You currently dont have any employees </span>--}}
                    {{--<button id="create_employees" class="btn btn-success"><i class="fa fa-user"></i>Create Employees</button>--}}
                {{--</div>--}}
                {{--@endif--}}
            {{--</div>--}}
            <div class="row" style="margin-top:2em;">
                <form id="employees_list" role="form" action="/add_team_members" method="post" class="col-sm-8">
                    {{ csrf_field() }}
                    <input hidden name="team_id" value="{{$team->id}}">
                    {{--<legend>Add existing employees</legend>--}}
                    {{--<fieldset>--}}
                    @foreach($employees as $employee)
                        <div class="form-check col-sm-6">
                            <input name="{{$employee->contact_number}}" type="checkbox" class="form-check-input" value="{{$employee->id}}">
                            <label class="form-check-label" for="{{$employee->contact_number}}">{{$employee->name . ' '. $employee->surname}}</label>
                        </div>
                    @endforeach
                        <div class="box-footer" style="margin-top:3em!important;">
                            <center>
                                <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save</button>
                            </center>
                        </div>
                    {{--</fieldset>--}}
                </form>
            </div>
        </div>
        {{--</div>--}}
    </div>
    {{--<div id="options" class="modal fade" style="display: block; margin-top: 5em;" data-backdrop="false">--}}
        {{--<div class="modal-dialog">--}}
            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>--}}
                    {{--<h5 class="modal-title">You currently do not have any employees.</h5>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}

                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button id="not_now" type="button" class="btn btn-default pull-left" data-dismiss="create_team_modal">Invite By Email--}}
                    {{--</button>--}}
                    {{--<button id="create_team" type="button" class="btn btn-success">Create Employees</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
@endsection
@push('datatable-scripts')
    <script type="text/javascript">
        console.log('Check');
        var holder = $.noConflict();
        holder(document).ready(function () {

        });


    </script>

@endpush




