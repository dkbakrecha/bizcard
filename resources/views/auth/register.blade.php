@extends('layouts.site.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <h2 class="formHeading-2">Sign up {{ config('app.name') }}</h2>
            <h3 class="formHeading-3">It's fast and easy.</h3>
    <form method="POST" id="registerSP" action="{{ route('register') }}" class="biz-form"  enctype="multipart/form-data">
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

                <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"  placeholder="{{ __('messages.confirm_password') }}">
                        </div>
            </div>
           
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12">
                <center>
                    <p class="textTerm">Creating an account means you’re okay with our Terms of Service, Privacy Policy, and our default Notification Settings.</p>
                    <button type="submit" class="btn btn-block">
                        {{ __('Create Account') }}
                    </button>
                </center>
            </div>
            
        </div>

        <div class="row">
            <div class="col-xs-12 verify center">
                <a href="{{ route("login") }}">Back to Sign In</a>
            </div>
        </div>
    </form>        
        </div>
    </div>
</div>

    


@endsection
