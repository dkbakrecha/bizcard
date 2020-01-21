@extends('layouts.site.app')

@section('content')
@include('elements.messages')

<div id="cms-header">
    <div class="container">
        <h3><img src="{{ asset("/images/lulu/Home.png") }}" class="cms-icon" alt="Page About Us"> About Us</h3>
    </div>
</div>

<div id="cms-primary">
    <div class="container">
        <section id="content" role="main" class="col-lg-8">
            <div class="entry-content">
                <p>
                    This is test about us page.
                </p>
            </div>
            
            <hr>
            <h4 class="heading-tag">Creative, friendly people dedicated to <br> producing ideas that work damn <br> hard for our clients</h4>
            <hr>
            
            <div class="team-info">
                <div class="col-lg-4 col-md-6  col-sm-6">
                    <img src="{{ asset("/images/avtar/classy_user_18.png") }}" >
                    <span class="name">Dharmendra</span>
                    <span class="role">Founder</span>
                </div>
                
                <div class="col-lg-4 col-md-6  col-sm-6">
                    <img src="{{ asset("/images/avtar/classy_user_11.png") }}" >
                    <span class="name">Veer</span>
                    <span class="role">Support</span>
                </div>
            </div>
        </section>
        
        @include('layouts.site.sidebar_cms')
    </div>
</div>   
@endsection