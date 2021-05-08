@extends('layouts.app')

@section('content')
<div class="page-margin d-flex flex-column justify-content-center">
    <section class="password-recovery container-sm card p-5 mb-5">
        <h2 class="mb-4">Password Recovery</h2>
        <form method="POST" class="text-start" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="mb-4">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" data-error="That email address is invalid" required autofocus>
                @if ($errors->has('email'))
                    <span class="error">
                    {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <button type="submit"  class="btn btn-primary btn-login">
                Send Email
            </button>
        </form>
    </section>
</div>
@endsection
