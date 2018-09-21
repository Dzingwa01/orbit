<!DOCTYPE html>
<html lang="en">
<head>
    <title>MiShift E-Mail Verification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class='container'>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Password Request Confirmation</h3></div>
                <div class="panel-body">
                    <br/>Hi {{$name}},
                    <br/>
                    This email servers to notify that your account is password is being reset. Complete new password
                    reset on the <b>MishiftApp App</b><br>
                    <a class="btn btn-success" href="{{url('/verify_forget_password/'.$user->_id)}}"
                    > Confirm Password Reset</a>
                    <br/>
                    Kind regards,<br/>
                    Orbit Team
                </div>
            </div>
        </div>
    </div>
</div>
</body>