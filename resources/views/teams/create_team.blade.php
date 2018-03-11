@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Team</h3>
                </div>
                <form role="form" id="add-team" action="/team" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="team_name">Team Name</label>
                                <input id="team_name" name="team_name" class="form-control" placeholder="Team Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="creator">Team Creator</label>
                                <select id="creator" name="creator" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name . ' ' . $user->surname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="package_prices">Team Description</label>
                                <input id="team_description" name="team_description" class="form-control" type="text" placeholder="Team Description">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="discount">City</label>
                                <select id="city_id" name="city_id" class="form-control">
                                    {{--@foreach($users as $user)--}}
                                        {{--<option value="{{$user->id}}">{{$user->name}}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </div>
                        </div>

                        <div class="box-footer">
                            <center>
                                <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
//                $.noConflict();
        $(document).ready(function ($) {
            $(function () {
//                $('#datetimepicker1').datetimepicker();
//                $('#datetimepicker2').datetimepicker();
                $('select').select2({
                    placeholder: 'Select or search an option'
                });
            });
        });
    </script>

@endpush()



