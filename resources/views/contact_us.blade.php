@extends('layouts.site.app')

@section('content')


<div id="cms-header">
    <div class="container">
        <h3><img src="{{ asset("/images/lulu/Mail.png") }}" class="cms-icon" alt="Page Contact Us"> Contact Us</h3>
    </div>
</div>

<div id="cms-primary">
    <div class="container">

        <section id="content" role="main" class="col-lg-8">
            <div class="entry-content">
                @include('elements.messages')
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                <form method="post" action="contact-us">
                    {{csrf_field()}}

                    <div class="form-group row">
                        <label class="col-md-3 control-label"> Name </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control @error('name') error @enderror" placeholder="Name" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 control-label"> Email </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control @error('email_address') is-invalid @enderror" placeholder="Email" name="email_address">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 control-label"> Phone Number </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number" name="phone_number">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 control-label"> Subject </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" name="subject">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 control-label"> Message </label>
                        <div class="col-sm-8">
                            <textarea class="form-control textarea @error('message') is-invalid @enderror" placeholder="Message" name="message" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-biz">Send</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>

        @include('layouts.site.sidebar_cms')
    </div>    
</div>
@endsection