@extends('layouts.main.auth')

@section('content')
<div class="unix-login">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="login-content">
                <div class="login-form">
                    <h4> <img src="{{ asset('images/logo.png') }}" alt="" /></h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group has-default has-feedback">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>                               
                                <span class="ti-user form-control-feedback"></span>
                            </div>
                        @if ($errors->has('name'))
                        <div class="alert alert-danger alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                
                                <strong>{{ $errors->first('name') }}</strong>
                        </div>
                        @endif

                        <div class="form-group form-group has-default has-feedback">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>                               
                                <span class="ti-email form-control-feedback"></span>
                            </div>
                        @if ($errors->has('email'))
                                <div class="alert alert-danger alert-dismissible fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>                                        
                                        <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif

                        <div class="form-group form-group has-default has-feedback">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span class="ti-lock form-control-feedback"></span>
                            </div>
                                @if ($errors->has('password'))
                                <div class="alert alert-danger alert-dismissible fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        
                                        <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                        

                        <div class="form-group form-group has-default has-feedback">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <span class="ti-reload form-control-feedback"></span>
                            </div>

                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">
                                    {{ __('Register') }}
                                </button>
                                
                                <div class="register-link text-center">
                                        <p>Have already acount ?<a href="/"> Login</a></p>
                                </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
