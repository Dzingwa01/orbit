@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="{{url('package/create')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Package</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="packages_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Team Size</th>
                        <th>Price</th>
                        <th>Discount</th>
                        {{--<th>Description</th>--}}
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
        $(document).ready(function ($) {
            $(function () {
                oTable = $('#packages_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('packages.get_packages')}}",
                    columns: [
                        {data: 'package_name', name: 'package_name'},
                        {data: 'number_of_members', name: 'number_of_members'},
                        {data: 'package_prices', name: 'package_prices'},
                        {data: 'discount', name: 'discount'},
//                        {data: 'package_description', name: 'package_description'},
                        {data: 'created_at', name: 'created_at'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

