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
                    Cardbiz is a 100% Indian fastest growing platform launched for all those who are startups, beginners, giants who are keen to offer their services but due to lack of platform they miss the opportunity. Cardbiz give them a hand to come over and showcase their services or products so they can be contacted and approached by desired customers. Apart from this, Cardbiz also give them a mini website space on cardbiz to showcase their offerings.
                </p>
                <p>
                    Cardbiz is operated & managed by a young professional team who is always ready to support those who are looking for the right podium. Cardbiz doesnt ask what is your market cap and whats your capital. Just one thing, what you offer. And if you have same enthusiasm and motto like us to serve customers than welcome to the plateform of Cardbiz
                </p>
            </div>
            
            <?php /* 
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
            */ ?>
            

        </section>
        
        @include('layouts.site.sidebar_cms')
    </div>
</div>   
@endsection