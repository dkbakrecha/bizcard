@extends('layouts.site.app')

@section('title', $card->business_name . ' | ')

@section('content')

@php 
$cateImgArr = array('1' => 'automotive.png', '2' => 'business.png', '3' => 'education.png', '4' => 'food.png', '5' => 'health.png', '6' => 'it.png', '7' => 'shop.png', '8' => 'sport.png', '9' => 'travel.png');


@endphp
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
<link href="{{ asset('main/dirfront_jay.css') }}" rel="stylesheet">
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
crossorigin=""></script>

<div class="card-default">
    <section class="card-top ">
        <div class="container">
            <div class="row">
                <div class="col-md-7">

                    <div class="card-name">
                        <span class="label label-primary">{{ $card['category']['name'] }}</span>                        
                        <h2>test</h2>

                        <h2 class="">{{ $card->business_name }}</h2>
                        <p class="keywords">{{ $card->keywords }}</p>
                        <p ><i class="fa fa-map-o"></i> {{ $card->address }}</p>
                        <div class="card-contact">
                            @guest
                            <a href="{{ route('login') }}" class="btn btn-detail contact-phone">
                                @else
                                <a href="tel:{{ $card['contact_primary'] }}" class="btn btn-detail contact-phone">
                                    @endguest

                                    <i class="fa fa-phone"></i> Call
                                    <?php /* str_repeat("*", 6) . substr($card['contact_primary'], 4) */ ?>
                                </a>            

                                @if(!empty($card->email_address))
                                <a href="mailto:{{ $card['email_address'] }}" class="btn btn-detail contact-email">
                                    <i class="fa fa-envelope"></i> Send Mail 
                                </a>
                                @endif

                                <a href="#" class="btn btn-detail favorite hide">
                                    <i class="fa fa-heart-o pr-1"></i> Favorite
                                </a> 


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="map-wrapper hide">
                        <div id="mapid"></div>

                        <ul class="list-unstyled text-right pull-right">


                            <li>
                                {{ $card->address }} <i class="fa fa-map-o"></i>
                            </li>
                        </ul>    
                    </div>


                </div>
            </div>
        </div>
    </section>
    <?php
    /*
      <section class="card-menu ">
      <div class="container">
      <div class="row">
      <div class="col-md-12 col-xl-5 order-xl-1 order-2 text-xl-right text-center">
      <ul class="nav nav-pills flex-column flex-sm-row lis-font-poppins" id="myTab" role="tablist">
      <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative mr-3 active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="true"> About</a> </li>
      <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative mr-3" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"> Product</a> </li>
      <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative mr-3" data-toggle="tab" href="#events" role="tab" aria-controls="events">Review</a> </li>
      <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative" data-toggle="tab" href="#booking" role="tab" aria-controls="booking"> Gallery</a> </li>
      </ul>
      </div>
      </div>
      </div>
      </section>

     */
    ?>
    <div class="profile-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 box-card-detail">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Overview</h4>
                                </div>
                                <div class="col-md-9">
                                    <div>        
                                        {{ $card->description }}
                                    </div>        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Social Profiles</h4>
                                </div>
                                <div class="col-md-9">
                                    <div>        
                                        <div class="card-social">
                                            @if (!empty($card->facebook))
                                            <a href="#" class="fa fa-facebook"></a>
                                            @endif
                                            @if (!empty($card->linkedin))
                                            <a href="#" class="fa fa-linkedin"></a>
                                            @endif
                                            @if (!empty($card->twitter))
                                            <a href="#" class="fa fa-twitter"></a>
                                            @endif
                                            @if (!empty($card->instagram))
                                            <a href="#" class="fa fa-instagram"></a>
                                            @endif
                                        </div>
                                    </div>        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Share</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="dropdown share-wrapper">
                                        <button class="btn btn-detail share" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa fa-share-alt pr-1"></i> Share
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    @if(file_exists( public_path().'/images/cards/'.$card->id.'-'.$card->slug.'.jpg' ))
                                    <a href="{{ asset('public/images/cards/'.$card['id'] .'-'. $card['slug'] .'.jpg') }}" class="btn btn-detail contact-email" download="{{$card->slug}}">
                                        <i class="fa fa-address-card-o"></i> Download Card
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Contact Info</h3>
                            <div>
                                <i class="fa fa-user-o"></i> {{ $card->business_person }}
                            </div>
                            <div>
                                <i class="fa fa-map-o"></i> {{ $card->address }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--  Detail card By Jay starts  -->
        <hr>
        <div>
            <section class="card-top ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-name">
                                <div class="card-name-heading">{{ $card->business_name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <hr>
        <!--  Detail card By Jay ends  -->



        <!-- Other Cards -->
        <div class="otherbusiness">
            <h3 class="section-title">Explorer More Business</h3>

            <div class="container clear-mob-pd">
                @foreach ($otherCards as $card)
                <div class="col-md-4 clear-mob-pd">
                    @include('elements.cardbox')
                </div>
                @endforeach 
            </div>

        </div>
    </div>    
</div>
<script>

var mymap = L.map('mapid').setView([26.263863, 73.008957], 11);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; CardBiz ',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1
}).addTo(mymap);

</script>

@endsection