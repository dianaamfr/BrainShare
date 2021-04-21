@extends('layouts.app')

@section('content')
<div class="page-margin d-flex flex-column justify-content-center">
    <section id="login" class="container-sm card p-5 mb-5">
        <h2 class="mb-4">Login</h2>
        <form method="POST" class="form-login text-start" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" data-error="That email address is invalid" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="error">
                    {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">Password <a href="#" class="form-text btn-link forgot-password justify-content-center float-end">Forgot Password</a></label>
                <input type="password" id="password" class="form-control" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="error">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <button type="submit"  class="btn btn-primary btn-login">
                Login
            </button>
            <a class="button button-outline" href="{{ route('register') }}">Register</a>
        </form>
        <div class="form-text mt-3 mb-1">No account yet? <a class="btn-link" href="register">Register now.</a></div>
    </section>
</div>
@endsection



