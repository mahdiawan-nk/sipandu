<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - SIPANDU Admin Dashboard</title>
    <link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.css">

    <link rel="shortcut icon" href="{{ url('') }}/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('') }}/assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h1 class="fw-bolder">SIPANDU</h1>
                                @if ($for == 'pengguna-ortu')
                                <h3>Sign In Orangtua</h3>
                                @else
                                <h3>Sign In </h3>
                                @endif
                                
                                <p>Please sign in to continue to SIPANDU.</p>
                            </div>
                            <form action="{{ route('checklogin') }}" method="POST">
                                @csrf
                                <div class="form-group position-relative has-icon-left">
                                    @if ($for == 'pengguna-ortu')
                                        <label for="username">NIK</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="username" name="nik">
                                            <div class="form-control-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                        </div>
                                    @else
                                        <label for="username">Email</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="username"
                                                name="email_pengguna">
                                            <div class="form-control-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password"
                                            name="password_pengguna">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ url('') }}/assets/js/feather-icons/feather.min.js"></script>
    <script src="{{ url('') }}/assets/js/app.js"></script>

    <script src="{{ url('') }}/assets/js/main.js"></script>
</body>

</html>
