@extends('adminlte::layouts.app')
<?php
$employees_count = count(DB::table('users')
    ->join('packages','packages.id','users.package_id')
    ->where('users.creator_id',Auth::user()->id)
    ->select('users.*','packages.package_name')->get());
?>
@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a id="create_shift" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Shift</a>

            </div>
            <a class="pull-right btn btn-primary" id="create_shift" onclick="goBack()" class="btn btn-primary">Back</a>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="teams_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Shift Duration</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    {{--<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>--}}

    <script type="text/javascript">
        $(document).ready(function ($) {
            $(function () {
                oTable = $('#teams_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('shifts.get_shifts')}}",
                    columns: [
                        {data: 'shift_title', name: 'shift_title'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'end_date', name: 'end_date'},
                        {data: 'shift_duration', name: 'shift_duration'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
                $("#create_shift").on('click',function () {
                    var counter = {{$employees_count}}
                    if(counter == 0){
                        $.notify("You currently do not have any employees, please add employees before creating a shift", "warning");
//                        window.location.href = 'employees';
                    }
                    else{
                        window.location.href = 'schedules/create';
                    }
                });
            });
        });
        function goBack(){
            window.history.back();
        }
    </script>

@endpush

