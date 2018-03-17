<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body style="margin-top: 5em;" >
{{--<div>--}}
    {{--<div class="wrapper">--}}

    @include('adminlte::layouts.partials.mainheader')
    @if($role->name=='Manager')
    @include('adminlte::layouts.partials.manager_sidebar')
    @elseif($role->name=='Employee')
        @include('adminlte::layouts.partials.employee_sidebar')
        @else
        @include('adminlte::layouts.partials.sidebar')
    @endif


    <!-- Content Wrapper. Contains page content -->
    {{--<div class="content-wrapper">--}}

        {{--@include('adminlte::layouts.partials.contentheader')--}}

        <!-- Main content -->
        <section class="content home" style="background-color: white;">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    {{--</div><!-- /.content-wrapper -->--}}

    {{--@include('adminlte::layouts.partials.controlsidebar')--}}

    {{--@include('adminlte::layouts.partials.footer')--}}

{{--</div><!-- ./wrapper -->--}}
{{--</div>--}}
{{--@section('scripts')--}}
    {{--@include('adminlte::layouts.partials.scripts')--}}
{{--@show--}}

{{--<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>--}}
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>--}}
{{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.js"></script>
<script src="/assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
<script src="/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="/assets/bundles/mainscripts.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
{{--<script src="assets/js/pages/index.js"></script>--}}

</body>
</html>
