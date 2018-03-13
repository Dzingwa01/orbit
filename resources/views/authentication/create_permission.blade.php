@extends('adminlte::layouts.app')
@section('main-content')
    <div class="container-fluid">
        {{--<div class="col-md-10">--}}
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Permission</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data" action="/save_permission"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Permission Name</label>
                                <input id="name" name="name" class="form-control" type="text" placeholder="Permission Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="display_name">Permission Display Name</label>
                                <input id="display_name" name="display_name" class="form-control" type="text"
                                       placeholder="Permission display name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="description">Permission Description</label>
                                <input id="description" name="description" class="form-control" type="text"
                                       placeholder="Permission description">
                            </div>

                        </div>

                        <div class="box-footer">
                            <center>
                                <button class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save
                                </button>
                            </center>
                        </div>
                    </div>
                </form>
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection
