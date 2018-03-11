@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" style="background-color: white;">
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="{{url('create_permission')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Permission</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="permissions_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Created At</th>
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
        console.log("sei sei");
        //    $.noConflict();
        $(document).ready(function ($) {
            $(function () {
                oTable = $('#permissions_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('permissions.get_permissions')}}",
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'display_name', name: 'display_name'},
                        {data: 'description', name: 'description'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
            });
        });

    </script>

    {{--@endpush--}}

