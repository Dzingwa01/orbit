@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid"  >
        {{--<div class="col-md-10">--}}
            <div class="box box-danger col-md-12" >
                <div class="box-header with-border">
                    <h3 class="box-title">Add employee</h3>
                </div>
                <form role="form" id="add-user" action="/employees" method="post">
                    {{ csrf_field() }}
                    <input name="role_id" value="{{$role->id}}" hidden>
                    <input name="creator_id" value="{{Auth::user()->id}}" hidden>
                    <input name="company_name" value="{{Auth::user()->company_name}}" hidden>
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="surname">Surname</label>
                                <input id="surname" name="surname" type="text" class="form-control" placeholder="Surname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" class="form-control" type="email" placeholder="Email Address" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" name="contact_number" type="tel" class="form-control" placeholder="Contact Number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="company_name">Gender</label>
                                <select id="gender" type="text" class="form-control"  style="background-color: white" name="gender" value="{{ old('company_name') }}" placeholder="select gender">

                                    <option>male</option>
                                    <option>female</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="company_name">Company Name</label>
                                <input id="company_name" name="company_name" class="form-control" type="text" placeholder="Company Name" disabled value="{{Auth::user()->company_name}}" required>
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

                        <div class="box-footer">
                            <center>
                                <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save</button>
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

            $("#email").blur(function () {
                var randomstring = Math.random().toString(36).slice(-8);
                $("#user_name").val($("#email").val());
                $("#password").val(randomstring);
            });
        });
    </script>

@endpush()



