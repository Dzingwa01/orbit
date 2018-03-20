@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >

        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">Add Task</h3>
            </div>
            <form role="form" id="add-task" action="/tasks" method="post">
                {{ csrf_field() }}

                <div class="box-body">
                    <div class="row">
                        <input name="creator_id" type="number" value="{{Auth::user()->id}}" hidden>
                        <div class="col-md-6 form-group">
                            <label for="name">Task Title</label>
                            <input id="name" name="name" class="form-control" placeholder="Task Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="creator">Task Creator</label>
                            <input class="form-control"  id="creator" value="{{Auth::user()->name . ' ' .Auth::user()->surname}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="description">Task Description</label>
                            <textarea id="description" name="description" class="form-control" type="text"></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="picture_url">Picture</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="task_date">Task Date</label>
                        <input type="date" name="task_date" class="form-control" class="date" class="form-control" />
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
            $('.date').datepicker({
                autoclose: true,
                dateFormat: "yy-mm-dd"
            });
        });
    </script>

@endpush()



