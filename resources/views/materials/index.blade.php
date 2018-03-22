@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="{{url('training_materials/create')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Training Material</a>

            </div>
            <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="teams_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Title</th>
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
                oTable = $('#teams_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('training_materials.get_materials')}}",
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
//                        {data: 'end_date', name: 'end_date'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });
        function goBack(){
            window.history.back();
        }
    </script>

@endpush

