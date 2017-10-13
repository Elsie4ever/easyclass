<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" type = "text/css" href = "/css/login_page.css" />
        <title>Welcome to easyClass</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))

                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else


            <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
            <div class="login_panel">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="logo"></div>
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} info_box">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control text" name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} info_box">
                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control text" name="password" required>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size: 10px;color: white;">Don't have an account? Please <a href="{{ url('/register') }}" style="color: white; ">sign up</a> here.</p>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary signin">
                                                Login
                                            </button>
                                            <a class="btn btn-link forget_pwd" href="{{ route('password.request') }}">
                                                Forgot Your Password?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>
    </body>
</html>
