@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        @if (session('status'))
            <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('error') }}
            </div>
        @endif
        <div class="row" style="margin-top:1em;">
            @if($employee_count>0)
                <a href="{{url('manager_teams/create')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Team</a>
            @else
                <span>You currently do not have users please create employees first </span>
                <a href="{{url('employees/create')}}" ><i class="fa fa-plus-square" disabled="disabled"></i> Create Employees</a>
            @endif



            <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="manager_teams_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Team Name</th>
                        {{--<th>Team Creator</th>--}}
                        {{--<th>City</th>--}}
                        <th>Team Description</th>
                        {{--<th>Created At</th>--}}
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
                oTable = $('#manager_teams_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('manager_teams.get_teams')}}",
                    columns: [
                        {data: 'team_name', name: 'team_name'},
//                    {data: 'name', name: 'name'},
//                    {data: 'city_name', name: 'city_name'},
                        {data: 'team_description', name: 'team_description'},
//                    {data: 'created_at', name: 'created_at'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]

                });
            });
            $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });
        });
        function goBack(){
            window.history.back();
        }
    </script>

@endpush


