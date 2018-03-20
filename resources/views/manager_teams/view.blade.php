@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >

        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Team Details</h3>
            </div>
            <form role="form" id="add-team" action="/manager_teams" method="post">
                {{ csrf_field() }}
                <input value="{{Auth::user()->id}}" name="creator" hidden>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="team_name">Team Name</label>
                            <input id="team_name" name="team_name" class="form-control" placeholder="Team Name" value="{{$team->team_name}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="creator">Team Creator</label>
                            <input class="form-control" type="text" value="{{Auth::user()->name . ' '. Auth::user()->surname}}" disabled="disabled">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="package_prices">Team Description</label>
                            <textarea id="team_description" name="team_description" class="form-control" type="text">{{$team->team_description}}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="discount">City</label>
                            <select id="city_id" name="city_id" class="form-control">
                                @foreach($cities as $city)
                                    <option {{$team->city_id==$city->id?'selected':''}} value="{{$city->id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>


                    {{--<div class="box-footer">--}}
                        {{--<center>--}}
                            {{--<button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Next</button>--}}
                        {{--</center>--}}
                    {{--</div>--}}
                </div>
            </form>
            <form>
                {{ csrf_field() }}
                <legend>Team Members</legend>
                <input hidden name="team_id" value="{{$team->id}}">
                {{--<fieldset>--}}
                @foreach($team_members as $team_member)
                    <div class="form-check col-sm-6">
                        <input name="{{$team_member->contact_number}}" type="checkbox" class="form-check-input" value="{{$team_member->id}}">
                        <label class="form-check-label" for="{{$team_member->contact_number}}">{{$team_member->name . ' '. $team_member->surname}}</label>
                    </div>
                @endforeach
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
    </script>

@endpush()



