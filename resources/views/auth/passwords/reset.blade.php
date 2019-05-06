@extends('layouts.main.auth')

@section('content')
<div class="unix-login">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="login-content">
                <div class="login-form">
                        <h4> <img src="{{ asset('images/logo.png') }}" alt="" /></h4>
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group has-default has-feedback">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse E-Mail') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                <span class="form-control-feedback large material-icons" style="color:black; top:28px;">mail</span>
                            </div>
                        @if ($errors->has('email'))
                        <div class="alert alert-danger alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                        @endif

                        <div class="form-group has-default has-feedback">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span class="form-control-feedback large material-icons" style="color:black; top:28px;">vpn_key</span>
                            </div>
                        @if ($errors->has('password'))
                        <div class="alert alert-danger alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>                            
                                <strong>{{ $errors->first('password') }}</strong>
                        </div>
                        @endif

                        <div class="form-group has-default has-feedback">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <span class="form-control-feedback large material-icons" style="color:black; top:28px;">security</span>
                            </div>


                     <button type="submit" class="btn btn-danger btn-rounded m-b-30 m-t-30">
                         {{ __('VALIDER') }}
                    </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
