@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        {{--<div class="col-md-10">--}}
            <div class="box box-danger col-md-12" >
                <div class="box-header with-border">
                    <h3 class="box-title">Add Package</h3>
                </div>
                <form role="form" id="add-package" action="/package" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="package_name">Package Name</label>
                                <input id="package_name" name="package_name" class="form-control" placeholder="Package Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="number_of_members">Team Size</label>
                                <input id="number_of_members" name="number_of_members" type="text" class="form-control" placeholder="Team Size">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="package_prices">Package Price</label>
                                <input id="package_prices" name="package_prices" class="form-control" type="text" placeholder="Package Price">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="discount">Package Discount</label>
                                <input id="discount" name="discount" type="tel" class="form-control" placeholder="Package Discount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="package_description">Package Description</label>
                                <textarea id="package_description" name="package_description" type="text" class="form-control" ></textarea>
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
        {{--</div>--}}
    </div>
@endsection
@push('datatable-scripts')
 <script>
        $(document).ready(function () {
                $('select').select2({
                    placeholder: 'Select or search an option'
                });
        });
    </script>

@endpush()



