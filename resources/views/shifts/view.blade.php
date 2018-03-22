@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >

        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Shift Details</h3>
                <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                <a class="pull-right btn btn-primary" id="create_shift" href="{{url('shifts/'.$shift->id.'/edit')}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Shift</a>

            </div>

            <form role="form" id="add-task">
                {{ csrf_field() }}

                <div class="box-body">
                    <div class="row">
                        <input name="creator_id" type="number" value="{{Auth::user()->id}}" hidden>
                        <div class="col-md-6 form-group">
                            <label for="name">Shift Title</label>
                            <input id="shift_title" name="shift_title" class="form-control" placeholder="Shift Title" value="{{$shift->shift_title}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="creator">Task Creator</label>
                            <input class="form-control"  id="creator" value="{{Auth::user()->name . ' ' .Auth::user()->surname}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="start_date">Start Date</label>
                                <input id='start_date' type='text' name="start_date" class="form-control" value="{{$shift->start_date}}"/>

                            </div>
                        </div>
                        <div class='col-sm-6 form-group'>
                            <div class="form-group">
                                <label class="control-label" for="end_date">End Date</label>
                                <input id='end_date' type='text' name="end_date" class="form-control" value="{{$shift->end_date}}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                    <form>
                    <div class="row">

                            {{ csrf_field() }}
                            <legend>Team Members</legend>
                            <input hidden name="team_id" value="{{$team->id}}">
                            {{--<fieldset>--}}
                            @foreach($team_members as $team_member)
                                <div class="form-check col-sm-6">
                                    <input name="{{$team_member->contact_number}}" checked type="checkbox" class="form-check-input" value="{{$team_member->id}}">
                                    <label class="form-check-label"  for="{{$team_member->contact_number}}">{{$team_member->name . ' '. $team_member->surname}}</label>
                                </div>
                            @endforeach
                    </div>
                    </form>
                </div>

        </form>
    </div>
    </div>
@endsection
@push('datatable-scripts')

    <script type="text/javascript">
        $(document).ready(function () {
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



