@extends('layouts.main.guestauth')
@section('content')
<div class="unix-login">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-lg-offset-3">
            <div class="login-content">
               <div class="login-form">
                  <h4> <img src="{{ asset('images/logo.png') }}" alt="" /></h4>
                  @if (session('error'))
                  <div class="alert alert-danger alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong style="color:black;">{{ session('error') }}</strong> 
                  </div>
                  @endif
                  @if (session('5/5'))
                  <div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong style="color:black;">{{ session('5/5') }}</strong> 
                  </div>
                  @endif
                  <form method="POST" action="{{ route('guestusers.password.email') }}">
                     @csrf
                     <div class="form-group has-default has-feedback">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nom d\'utilisateur') }}</label>
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        <span class="form-control-feedback large material-icons" style="color:black; top:28px;">person</span>
                     </div>
                     @if ($errors->has('email'))
                     <div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Nom d'utilisateur incorrect !</strong> 
                     </div>
                     @endif
                     <button type="submit" class="btn btn-success btn-rounded m-b-30 m-t-30">
                     {{ __('Envoyer le nouveau mot de passe') }}
                     </button>
                     <div class="register-link text-center">
                        <p>REVENIR AU FORMULAIRE DE  <a style="color:magenta;" href="{{route('guestusers.login')}}"> <strong> CONNEXION</strong></a></p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection