@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        {{--<div class="col-md-10">--}}
        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">View City</h3>
            </div>
            <form role="form" id="add-city">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="package_name">Name</label>
                            <input id="package_name" name="package_name" class="form-control" placeholder="City Name" value="{{$city->city_name}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="description">Package Description</label>
                            <textarea id="description" name="description" type="text" class="form-control" >{{$city->description}}</textarea>
                        </div>
                    </div>


                </div>
            </form>
        </div>
        {{--</div>--}}
    </div>
@endsection




