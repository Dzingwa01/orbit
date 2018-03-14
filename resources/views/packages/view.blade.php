@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        {{--<div class="col-md-10">--}}
        <div class="box box-danger col-md-12" >
            <div class="box-header with-border">
                <h3 class="box-title">View Package</h3>
            </div>
            <form role="form" id="add-package">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="package_name">Package Name</label>
                            <input id="package_name" name="package_name" class="form-control" placeholder="Package Name" value="{{$package->package_name}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="number_of_members">Team Size</label>
                            <input id="number_of_members" name="number_of_members" type="text" class="form-control" placeholder="Team Size" value="{{$package->team_size}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="package_prices">Package Price</label>
                            <input id="package_prices" name="package_prices" class="form-control" type="text" placeholder="Package Price" value="{{$package->package_prices}}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="discount">Package Discount</label>
                            <input id="discount" name="discount" type="tel" class="form-control" placeholder="Package Discount" value="{{$package->discount}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="package_description">Package Description</label>
                            <textarea id="package_description" name="package_description" type="text" class="form-control" >{{$package->package_description}}</textarea>
                        </div>

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



