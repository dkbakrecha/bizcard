@extends('layouts.site.app')

@section('content')
@include('elements.messages')

<div id="cms-header">
    <div class="container">
        <h3><img src="{{ asset("/images/lulu/Trophy.png") }}" class="cms-icon" alt="Features Cardbiz.in"> Features</h3>
    </div>
</div>

<div id="cms-primary">
    <div class="container">
        <section id="content" role="main" class="col-lg-8">
            <div class="entry-content">
                <p>
                    1. We update your services on regular basis.
                </p>
                <p>
                2. Cardbiz works on a very different method of digital marketing which enables you to boost your services or business organically.
                </p>
                <p>
                3. It can be updated as per your business need on a very low maintenance fee; infact as low as your one time dinner.
                </p>
                <p>
                4. Cardbiz is free. It gives you business calls and messages directly to your registered number without any 3rd party involvement.
                </p>
                <p>
                5. No extra charges for leads.
                </p>
                <p>
                6. Cardbiz gives you a mini web version of your own website and so do the contact information remains yours only.
                </p>
                <p>
                7. Like we said earlier, we dont ask who you are or where you belong? If you have the same enthusiasm and vision to take your business to new heights like us then welcome to Cardbiz.
                </p>
                <p>
                    8. Our customer's service is active 24/7  so you can be rest assured for the assistance.
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