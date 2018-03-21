@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Role Details</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data" action="/employee_update_role/{{$role->id}}"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <input name="role_creator" hidden type="number" value="{{Auth::user()->id}}">
                            <div class="col-md-6 form-group">
                                <label for="role_name">Role Name</label>
                                <input id="role_name" name="role_name" class="form-control" type="text" placeholder="Role Name" value="{{$role->role_name}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="role_display_name">Role Display Name</label>
                                <input id="role_display_name" name="role_display_name" class="form-control" type="text"
                                       placeholder="Role display name" value="{{$role->role_display_name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="role_description">Role Description</label>
                                <input id="role_description" name="role_description" class="form-control" type="text"
                                       placeholder="Role description"    value="{{$role->role_description}}">
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
            </div>
        </div>
    </div>
@endsection
