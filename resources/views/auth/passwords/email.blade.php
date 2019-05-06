@extends('layouts.main.auth')

@section('content')
<div class="unix-login">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="login-content">

                <div class="login-form">
                        <h4> <img src="{{ asset('images/logo.png') }}" alt="" /></h4>
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{ session('status') }}</strong> 
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group has-default has-feedback">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse E-Mail') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <span class="form-control-feedback large material-icons" style="color:black; top:28px;">mail</span>
                            </div>
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger alert-dismissible fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Email incorrect !</strong> 
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-success btn-rounded m-b-30 m-t-30">
                                    {{ __('Envoyer le lien de connexion') }}
                                </button>
                                <div class="register-link text-center">
                                        <p>REVENIR AU FORMULAIRE DE  <a style="color:red;" href="/"> <strong> CONNEXION</strong></a></p>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
