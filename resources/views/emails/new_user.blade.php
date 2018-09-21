<h1></h1>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MiShift - EMail Verification</title>
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
                <div class="panel-heading"><h3>Verify Your Email</h3></div>
                <div class="panel-body">
                    <br/> Click the following link to verify your email. <a
                            href="{{url('/verifyemail/'.$email_token)}}">
                        Confirm Email</a><br/>
                    <br/>
                    Kind regards,<br/>
                    Orbit Team
                </div>
            </div>
        </div>
    </div>
</div>
</body>