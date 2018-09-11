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
					<li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> MiShift</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ul>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 text-right">
				<button class="btn btn-primary btn-round btn-simple hidden-sm-down float-right m-l-10">Create New</button>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="body">
						<h3 class="m-b-0 number count-to" data-from="0" data-to="1600" data-speed="2000" data-fresh-interval="700">1600 <i class="zmdi zmdi-trending-up float-right"></i></h3>
						<p class="text-muted">Users</p>
						<div class="progress">
							<div class="progress-bar l-blush" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
						</div>
						<small>Change 15%</small>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="body">
						<h3 class="m-b-0">500 <i class="zmdi zmdi-trending-up float-right"></i></h3>
						<p class="text-muted">Teams</p>
						<div class="progress">
							<div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
						</div>
						<small>Change 5%</small>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="body">
						<h3 class="m-b-0 number count-to" data-from="0" data-to="2105" data-speed="2000" data-fresh-interval="700">2105 <i class="zmdi zmdi-trending-up float-right"></i></h3>
						<p class="text-muted">Packages</p>
						<div class="progress">
							<div class="progress-bar l-parpl" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
						</div>
						<small>Change 23%</small>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="body">
						<h3 class="m-b-0 number count-to" data-from="0" data-to="2105" data-speed="2000" data-fresh-interval="700">50.5GB <i class="zmdi zmdi-trending-up float-right"></i></h3>
						<p class="text-muted">Training Material</p>
						<div class="progress">
							<div class="progress-bar l-blue" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
						</div>
						<small>Change 12%</small>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection
