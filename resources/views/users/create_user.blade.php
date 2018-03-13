@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid"  >
        {{--<div class="col-md-10">--}}
            <div class="box box-danger col-md-12" >
                <div class="box-header with-border">
                    <h3 class="box-title">Add User</h3>
                </div>
                <form role="form" id="add-user" action="/user" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="surname">Surname</label>
                                <input id="surname" name="surname" type="text" class="form-control" placeholder="Surname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" class="form-control" type="email" placeholder="Email Address">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" name="contact_number" type="tel" class="form-control" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="username">ID Number</label>
                                <input id="depot" name="id_number" type="text" class="form-control" placeholder="ID Number">
                            </div>
                            <div class="col-md-6">
                                <label for="role_id">Role</label>
                                <select id="role_id" name="role_id" class="form-control">
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
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
@endsection
@push('datatable-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#role_id').select2({
                placeholder: 'Select or search an option'
            });
        });
    </script>

@endpush()



