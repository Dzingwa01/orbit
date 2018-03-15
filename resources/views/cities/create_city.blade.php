@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        {{--<div class="col-md-10">--}}
        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Add City</h3>
            </div>
            <form role="form" id="add-city" action="/city" method="post">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="package_name">Name</label>
                            <input id="city_name" name="city_name" class="form-control" placeholder="City Name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="description">Package Description</label>
                            <textarea id="description" name="description" type="text" class="form-control" ></textarea>
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
        {{--</div>--}}
    </div>
@endsection




