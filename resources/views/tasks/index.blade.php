@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="{{url('tasks/create')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Task</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="teams_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    <script type="text/javascript">
        $(document).ready(function ($) {
            $(function () {
                oTable = $('#teams_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('tasks.get_tasks')}}",
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'end_date', name: 'end_date'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });

        });

    </script>

@endpush

