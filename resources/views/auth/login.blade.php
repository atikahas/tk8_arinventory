<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>TK8 Admin</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
        <link id="sleek-css" rel="stylesheet" href="{{url('')}}/sleek/theme/assets/css/sleek.css" />
        <link href="{{url('')}}/sleek/theme/assets/img/favicon.png" rel="shortcut icon" />
        <script src="{{url('')}}/sleek/theme/assets/plugins/nprogress/nprogress.js"></script>
    </head>

    <body class="" id="body">
        <div class="container d-flex align-items-center justify-content-center vh-100">
            <div class="row justify-content-center">
                <div class=" col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="app-brand">
                                <a href="{{ url('login') }}">
                                    <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                                        <g fill="none" fill-rule="evenodd">
                                            <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                            <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                        </g>
                                    </svg>
                                    <span class="brand-name">AR Inventory</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-5">
                            <h4 class="text-dark mb-5">Sign In</h4>
                            <form method="post" action="{{ route('login.perform') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="email" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                                        @if ($errors->has('username'))
                                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="password" class="form-control input-lg" name="password" value="{{ old('password') }}" placeholder="Password" required="required" autocomplete="on">
                                        @if ($errors->has('password'))
                                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{url('')}}/sleek/theme/assets/plugins/jquery/jquery.min.js"></script>
        <script src="{{url('')}}/sleek/theme/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>