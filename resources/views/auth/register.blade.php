@extends('layouts.register')

@section('content')

    <p class="login-box-msg reset-pwd-heading register-heading">{{ __('Register Here') }}</p>
    <form method="POST" id="registerSP" action="{{ route('register') }}" class="form-horizontal"  enctype="multipart/form-data">
        @csrf

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                        <input id="name" type="text" placeholder="{{ __('messages.name') }}" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                        <input id="phone" type="text" placeholder="{{ __('messages.phone') }}" class="form-control" name="phone" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                        <input id="email" type="text" placeholder="{{ __('messages.email_address') }}" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                        <input id="password" type="password" placeholder="{{ __('messages.password') }}" class="form-control" name="password">
                </div>

                <div class="form-group row">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
            </div>
           
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12 btn-create">
                <center>
                    <button type="submit" class="btn btn-primary register-btn">
                        {{ __('Create') }}
                    </button>
                </center>
            </div>
            <div class="col-md-12">
                <a href="{{ route("login") }}">Back to Sign In</a> | <a href="{{ route("appterms") }}">Terms of Use</a>
            </div>
        </div>
    </form>
@endsection
