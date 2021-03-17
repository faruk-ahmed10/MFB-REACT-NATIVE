<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template -->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }

        .global-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        form {
            padding-top: 10px;
            font-size: 14px;
            margin-top: 30px;
        }

        .card-title {
            font-weight: 300;
        }

        .btn {
            font-size: 14px;
            margin-top: 20px;
        }


        .login-form {
            width: 330px;
            margin: 20px;
        }

        .sign-up {
            text-align: center;
            padding: 20px 0 0;
        }

        .alert {
            margin-bottom: -30px;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="global-container">
    <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Login</h3>
            <div class="card-text">
                @if(Session::has('creds_error'))
                    <div class="alert alert-danger">{{ Session::get('creds_error') }}</div>
            @endif
            <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                <form method="POST" action="/login">
                @csrf
                <!-- to error: add class "has-danger" -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail1"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm"
                               id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/assets/js/demo/datatables-demo.js"></script>

</body>
</html>
