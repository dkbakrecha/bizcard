<!-- Service Provider and Supervisor Login Form -->
@extends('layouts.site.app')

@section('content')
@section('sectionTitle', __('Login'))

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <button class="close" data-dismiss="alert">&times;</button>
    <p>{{ $message }}</p>
</div>
@endif

<div class="container">
    <div class="row">

        <div class="col-lg-4 col-lg-offset-4">
            <h2 class="formHeading-2">Sign in to {{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('login') }}" class="biz-form">
        @csrf


        <div class="form-group  has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="text" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-block">
                    {{ __('Log In') }}
                </button>
            
            </div>
        </div>

        <?php /*
        <div id="my-signin2" class="g-signin2"></div>

        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button>
        */ ?>
        
        <div class="row">
            <div class="col-xs-12 verify center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Password ?') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 center">
                <a class="btn btn-biz green" href="{{ route('register') }}">
                    {{ __('Register New Profile') }}
                </a>
            </div>
        </div>
    </form>        
        </div>

    
    
    </div>
    
</div>
@endsection