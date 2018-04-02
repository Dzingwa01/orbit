@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Password recovery
@endsection

@section('content')

<body class="login-page">
    <div id="app">

        <div class="login-box">
        <div class="login-logo">
            <a href="/"><img src="/img/orbit_logo_new.png" alt="orbit"></a>
        </div><!-- /.login-logo -->

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">Reset Password</p>

            {{--<email-reset-password-form></email-reset-password-form>--}}
            <div class="form-group has-feedback">
                <input type="email" class="form-control" style="background-color: white"
                       placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"/>
                {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
            </div>
            <div class="row">
                <div class="col-xs-4 pull-right">
                    <button type="submit"
                            class="btn btn-primary btn-block btn-flat">Reset</button>
                </div><!
            </div>
            <br>
        </div><!-- /.login-box-body -->
            <a href="{{ url('/login') }}">Log in</a><br>
            <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a>
        </div><!-- /.login-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
