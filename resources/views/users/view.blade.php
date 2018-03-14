@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="col-md-10">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">User Details</h3>
                </div>
                <form role="form">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" class="form-control" placeholder="Name" value="{{$user->name}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="surname">Surname</label>
                                <input id="surname" name="surname" type="text" class="form-control" value="{{$user->surname}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" class="form-control" type="email" value="{{$user->email}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" name="contact_number" type="tel" class="form-control" placeholder="Contact Number" value="{{$user->contact_number}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="role_id">Role</label>
                                <select id="role_id" name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                        <option {{$user->role_id == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="package_id">Package</label>
                                <select id="package_id" name="package_id" class="form-control">
                                    <option></option>
                                    @foreach($packages as $package)
                                        <option {{$user->package_id == $package->id ? 'selected' : ''}} value="{{$package->id}}">{{$package->package_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <label>*Auto generated credentials - Send these credentials to the user</label>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="user_name">User Name</label>
                                <input id="user_name" name="user_name" type="text" class="form-control" value="{{$user->user_name}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="username">Password</label>
                                <input id="password" name="password" type="text" class="form-control" placeholder="Password">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2({
                placeholder: 'Select or search an option'
            });

            $("#email").blur(function () {
                var randomstring = Math.random().toString(36).slice(-8);
                $("#user_name").val($("#email").val());
                $("#password").val(randomstring);
            });
        });
    </script>

@endpush()



