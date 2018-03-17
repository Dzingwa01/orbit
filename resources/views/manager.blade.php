@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                <ul class="breadcrumb p-l-0 p-b-0 ">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Orbit</a></li>
                    <li class="breadcrumb-item active">Manager Dashboard</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                <button class="btn btn-primary btn-round btn-simple hidden-sm-down float-right m-l-10">Create New</button>
            </div>
        </div>
    </div>

@endsection
