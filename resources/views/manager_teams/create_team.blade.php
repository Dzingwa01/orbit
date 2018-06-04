@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >

            <div class="box box-danger col-md-12" >
                <div class="box-header with-border">
                    <h3 class="box-title">Add Team</h3>
                </div>
                <form role="form" id="add-team" action="/manager_teams" method="post">
                    {{ csrf_field() }}
                    <input value="{{Auth::user()->id}}" name="creator" hidden>
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="team_name">Team Name</label>
                                <input id="team_name" name="team_name" required class="form-control" placeholder="Team Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="creator">Team Creator</label>
                                <input class="form-control" type="text" required value="{{Auth::user()->name . ' '. Auth::user()->surname}}" disabled="disabled">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="package_prices">Team Description</label>
                                <textarea id="team_description" required name="team_description" class="form-control" type="text"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="discount">City</label>
                                <select id="city_id" name="city_id" required class="form-control">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="box-footer">
                            <center>
                                <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Next</button>
                            </center>
                        </div>
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
    </script>

@endpush()



