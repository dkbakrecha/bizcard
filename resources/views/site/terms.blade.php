@extends('layouts.site.app')

@section('title', 'Privacy & Terms | ')

@section('content')
@include('elements.messages')

<div id="cms-header">
    <div class="container">
        <h3><img src="{{ asset("/images/lulu/Folder.png") }}" class="cms-icon" alt="Privacy & Terms cardbiz.in"> Privacy & Terms</h3>
    </div>
</div>

<div id="cms-primary">
    <div class="container">
        <section id="content" role="main" class="col-lg-8">
            <div class="entry-content">
                <p>
                    1. The content, logo  and other visual media we have created in cardbiz is our property and solely provided by us and comes under copyright laws. 
                </p>
                <p>
                    2. Your account on cardbiz or the data you have submitted on site can be terminated or remove incase of abuse/fake/wrong information.
                </p>
                <p>
                    3. We will not be responsible for any 3rd party website links you have associated with cardbiz.
                </p>
                <p>
                    4. Cardbiz gives space to users for their offerings, service and product showcase. The services are provided to the subject of space purchased/alloted. Cardbiz has the right to modify, change or discontinue any aspect of service at anytime although we will always keep you updated for the same.
                </p>
                <p>
                    5. Prices are quoted and billed in INR unless the client requests for other currency due to unavailability or subject to cardbiz authority approval.
                </p>
                <p>
                    6. Accounts will be discontinued if its fees are not paid in timely manner of 3 days of the due date decided.
                </p>
                <p>
                    7. When you signup for cardbiz you will be requested for id and password. You acknowledge and agree that it is your responsibility to keep your credentials safe and do not let anybody allow for unauthorised access. Cardbiz will not be responsible for any vulnerable or malfunctioned behaviour of your Cardbiz information arised out of unauthorised acess.
                </p>
                <p>
                    8. As far as your data privacy concern, your data will not been shared with any 3rd party organization or company although it will be used by us only to ensure the quality of service we strive to fecilate you.
                </p>
            </div>
            

        </section>
        
        @include('layouts.site.sidebar_cms')
    </div>
</div>   
@endsection