@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        {{--<div class="col-md-10">--}}
        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Add Team Members</h3>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button id="email_invite" class="btn btn-success">Invite by Email</button>
                </div>
                <div class="col-sm-2">
                    <button id="create_employees" class="btn btn-success">Create Employees</button>
                </div>
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
    {{--<script type="text/javascript">--}}
        {{--console.log('Check');--}}
        {{--var holder = $.noConflict();--}}
        {{--holder(document).ready(function () {--}}
            {{--var employees_counter = 0;--}}
            {{--console.log('Check');--}}
            {{--employees_counter = {{count(\App\User::where('creator_id',Auth::user()->id)->get())}}--}}
                {{--console.log("count" + employees_counter);--}}
            {{--if (employees_counter == 0) {--}}
                {{--holder('#options').modal('show');--}}
            {{--}--}}
            {{--holder('#not_now').on('click', function () {--}}
                {{--holder('#create_team_modal').modal('hide');--}}
                {{--{{Auth::user()->update(array('logins_counter' => 1))}}--}}
            {{--});--}}
            {{--holder('#create_team').on('click', function () {--}}
                {{--alert('Clicked');--}}
            {{--});--}}

        {{--});--}}


    {{--</script>--}}

@endpush




