@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Role Details</h3>
                </div>
                <form role="form">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Role Name</label>
                                <input id="name" name="name" class="form-control" type="text" placeholder="Role Name" value="{{$role->role_name}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="display_name">Role Display Name</label>
                                <input id="display_name" name="display_name" class="form-control" type="text"
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


                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
