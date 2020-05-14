@extends('layouts.site.app')

@section('content')
@include('elements.messages')


<div class="hr-line"></div>
<?php

$userData = Auth::guard('web')->user();

//$userData['User']['first_name'] = "Dharmendra";
//$userData['User']['last_name'] = "Bagrecha";
//$userData['User']['email'] = "dkbakrecha@gmail.com";
//pr($userData);
//pr($userRooms);
?>
<div class="container" id="roomContent">


    <div class="row">
        <div class="col-lg-3">
            @include('layouts.site.sidebar_user')

             <div class="panel panel-default dashboard hide">
                <div class="panel-title">
                    Tips
                </div>
                <div class="panel-body">
                    For any suggestion direct chat with admin support
                </div>
              </div>
        </div>


        <div class="col-lg-9">
            <?php
            /*
                <div class="alert alert-warning dashboard-top" role="alert"> 
                <strong>Verify your email address</strong> 
                <div>To help keep your account secure, please verify your email address. Send a verification email to <?php echo $userData['User']['email'] ?> or update your email address. </div>
                <a href="" class="btn btn-default">Send verification email</a>
            </div>
            */
            ?>

            <div class="panel panel-default">
                <div class="panel-body">
                    <blockquote>
                        <?php //pr($userData); ?>
                        <p>Welcome, We're glad you're here!</p>
                    </blockquote>

                    <div class="btn-submitproperties pull-right">
                        <a href="{{ route('card.create') }}">
                            <span id="subup"><i class="fa fa-briefcase"></i></span>
                            <span id="subct">Free Business Profile</span>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>


@endsection