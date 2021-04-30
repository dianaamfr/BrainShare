@extends('layouts.app')

@section('content')
<div class="page-margin d-flex flex-column justify-content-center">
  <section id="register" class="container-sm card p-5">
    <h2 class="mb-4">Register</h2>
    <form method="POST" action="{{ route('register') }}" class="text-start" data-toggle="validator">
        {{ csrf_field() }}

        <div class="mb-4 text-center">
            <img class="bd-placeholder-img img-thumbnail rounded-circle mb-3" id="register-image" src="{{asset('images/profile.png')}}" alt="profile image">
            <div class="mb-4">
            <input type="file" id="register-file" class="form-control-file">
            <label for="register-file" class="custom-file-upload btn-link">
                <i class="fa fa-upload"></i> Profile picture
            </label>
            </div>
        </div>

        <div class="mb-4">
          <label for="username" class="form-label">Username*</label>
          <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username" required autofocus>
          @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
            </span>
          @endif
        </div>

        <div class="mb-4">
          <label for="email" class="form-label">E-Mail*</label>
          <input id="email" class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" data-error="That email address is invalid" required>
          @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
          @endif
        </div>
        
        <div class="mb-4">
          <label for="password" class="form-label">Password*</label>
          <input id="password" class="form-control" type="password" name="password" data-minlength="8" class="form-control" placeholder="Password" required>
          @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif
        </div>
        
        <div class="mb-4">
          <label for="password-confirm" class="form-label">Confirm Password*</label>
          <input id="password-confirm" class="form-control" type="password"  data-match="#password" name="password_confirmation" data-match-error="Whoops, these don't match" placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-register">
          Register
        </button>
        <a class="button button-outline" href="{{ route('login') }}">Login</a>
    </form>
  </section> 
</div>
@endsection
