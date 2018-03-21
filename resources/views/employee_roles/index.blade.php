@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" style="background-color: white;">
        <div class="row" >
            <div class="col-sm-2">
                <a href="{{url('/employee_create_role')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Role</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="roles_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

    $(document).ready(function ($) {
        $(function () {
            oTable = $('#roles_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('employee_roles.get_roles')}}",
                columns: [
                    {data: 'role_name', name: 'role_name'},
                    {data: 'role_display_name', name: 'role_display_name'},
                    {data: 'role_description', name: 'role_description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    });

</script>

{{--@endpush--}}

