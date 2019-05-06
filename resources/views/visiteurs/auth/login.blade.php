@extends('layouts.main.guestauth')
@section('content')
<div class="unix-login">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-lg-offset-3">
            <div class="login-content">
               <div class="login-form">
                  <h4> <img src="{{ asset('images/logo.png') }}" alt="stylimmo" /></h4>
                  @if (session('error'))
                  <div class="alert alert-danger alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong style="color:black;">{{ session('error') }}</strong> 
                  </div>
                  @endif
                  <form method="POST" action="{{ route('guestusers.login.submit') }}">
                     @csrf
                     <div class="form-group has-default has-feedback">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Nom d\'utilisateur') }}</label>
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        <span class="form-control-feedback large material-icons" style="color:black; top:28px;">person</span>
                     </div>
                     @if ($errors->has('email'))
                     <div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Informations incorrectes ! </strong> 
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
                        <strong>Informations incorrectes ! </strong>
                     </div>
                     @endif
                     <div class="form-group">
                        <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >{{ __('  Se souvenir de moi') }}
                        </label>
                        <label class="pull-right">
                        <a style="color:red;" href="{{ route('guestusers.password.request') }}"><strong>{{ __('Mot de passe oublié ?') }}</strong></a>
                        </label>
                     </div>
                     <button type="submit" class="btn btn-pink btn-rounded">
                     {{ __('Connexion') }}
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection