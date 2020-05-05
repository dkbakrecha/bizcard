@extends('layouts.site.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <h2 class="formHeading-2">Reset Password</h2>
            <h3 class="formHeading-3">Please generate new password here</h3>
    <form method="POST" id="registerSP" action="{{ route('resetpassword', $token) }}" class="biz-form"  enctype="multipart/form-data">
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
                        <input id="phone_show" type="text" placeholder="{{ __('messages.phone') }}" class="form-control" name="phone_show" value="{{ $user->phone }}" disabled>

                        <input id="phone" type="hidden" name="phone" value="{{ $user->phone }}">
                        ({{ $user->token }})
                </div>

                <div class="form-group">
                        <input id="otp" type="text" placeholder="Enter 4 digit OTP here" class="form-control" name="otp" value="" data-mask="0000">
                </div>


                <div class="form-group">
                        <input id="password" type="password" placeholder="Enter secure password here" class="form-control" name="password" value="{{ old('password') }}">
                </div>
            </div>
           
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12">
                <center>
                    <button type="submit" class="btn btn-block">
                        {{ __('Verify OTP') }}
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