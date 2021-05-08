@extends('layouts.app')

@section('content')
<div class="page-margin d-flex flex-column justify-content-center">
  <section class="password-recovery container-sm card p-5">
    <h2 class="mb-4">Password Recovery</h2>
    <form method="POST" action="{{ route('password.update') }}" class="text-start" data-toggle="validator">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{$token}}">

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
          <input id="password" class="form-control" type="password" name="password" data-minlength="8" placeholder="Password" required>
          @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif
        </div>
        
        <div class="mb-4">
          <label for="password_confirmation" class="form-label">Confirm Password*</label>
          <input id="password_confirmation" class="form-control" type="password"  data-match="#password" name="password_confirmation" data-match-error="Whoops, these don't match" placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-register">
          Save New Password
        </button>
    </form>
  </section> 
</div>
@endsection
