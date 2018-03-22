@extends('adminlte::layouts.app')
<?php
$users_count = count(DB::table('users')
    ->join('packages','packages.id','users.package_id')
    ->where('users.creator_id',Auth::user()->id)
    ->select('users.*','packages.package_name')->get());
$user = DB::table('users')
    ->join('packages','packages.id','users.package_id')
    ->where('users.id',Auth::user()->id)
    ->select('users.*','packages.number_of_members')->first();
$package_size = $user->number_of_members;
?>
@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a id="create_employee"  class="btn btn-success"><i class="fa fa-plus-square"></i> Add Employee</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="users_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Company Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    {{--<script--}}
            {{--src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
            {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
            {{--crossorigin="anonymous"></script>--}}
    {{--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript">
        $(document).ready(function ($) {
            $(function () {
                oTable = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('employees.get_employees')}}",
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'surname', name: 'surname'},
//                        {data: 'user_name', name: 'user_name'},
                        {data: 'email', name: 'email'},
//                        {data: 'contact_number', name: 'contact_number'},
//                        {data: 'package_name', name: 'package_name'},
                        {data: 'company_name', name: 'company_name'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
            $("#create_employee").on('click',function () {
                var counter = {{$package_size}}
                    var employee_count = {{$users_count}}
                if(employee_count <= counter){
                    window.location.href = 'employees/create';
                }
                else{
                    $.notify("You currently do not have any employees, please add employees before creating a shift", "warning");
                }
            });
        });

    </script>

@endpush

