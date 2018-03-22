@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Onboarding Material</h3>
                </div>
                <form role="form" id="add-material" enctype="multipart/form-data"
                      action="/onboarding_materials"
                      method="post">
                    {{ csrf_field() }}

                    <div class="box-body">
                        <input type="text" name="creator_id" value="{{Auth::user()->id}}" hidden>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Title</label>
                                    <input id="name" name="name" type='text' class="form-control"
                                           />

                            </div>

                            <div class="col-md-6 form-group">
                                <label for="end_date">Description</label>

                                    <textarea id="description" name="description"  class="form-control"
                                    ></textarea>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="file_url">Material File</label>
                                <input id="file_url" name="file_url" class="form-control" type="file"
                                       placeholder="Upload File Url">
                            </div>

                        </div>

                    </div>

                    <div class="box-footer">
                        <center>
                            <button class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save
                            </button>
                        </center>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    <script type="text/javascript">
        $.noConflict();
        jQuery(document).ready(function ($) {
            $(function () {
                $('#datetimepicker1').datetimepicker();
                $('#datetimepicker2').datetimepicker();
                $('select').select2({
                    placeholder: 'Select or search an option'
                });
            });

        });

    </script>

@endpush()
