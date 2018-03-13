<head>
    <meta charset="UTF-8">
    <title> Orbit </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    {{--<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->--}}
    {{--<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>--}}
    {{--<link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" />--}}
    {{--<!-- Custom Css -->--}}
    {{--<link rel="stylesheet" href="assets/css/main.css">--}}
    {{--<link rel="stylesheet" href="assets/css/color_skins.css">--}}


    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    {{--<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>--}}
    {{--<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet"/>--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.14/jquery.datetimepicker.css"--}}
          {{--rel="stylesheet">--}}



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="/js/app.js" ></script>-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>--}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.14/jquery.datetimepicker.full.min.js"></script>--}}
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>--}}
    {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}

    {{--<script src="/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->--}}
    {{--<script src="/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->--}}

    {{--<script src="/assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->--}}
    {{--<script src="/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->--}}
    {{--<script src="/assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->--}}

    {{--<script src="/assets/bundles/mainscripts.bundle.js"></script>--}}
    {{--<script src="/assets/js/pages/index.js"></script>--}}
    {{--<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.css" />
    <link rel="stylesheet" href="/assets/plugins/morrisjs/morris.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/color_skins.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet"/>

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
    @stack('datatable-scripts')

</head>
