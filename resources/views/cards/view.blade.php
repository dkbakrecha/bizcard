@extends('layouts.site.app')

@section('content')
    
    @php 
        $cateImgArr = array('1' => 'automotive.png', '2' => 'business.png', '3' => 'education.png', '4' => 'food.png', '5' => 'health.png', '6' => 'it.png', '7' => 'shop.png', '8' => 'sport.png', '9' => 'travel.png');

        
    @endphp
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

<div class="card-default">
    <section class="card-top ">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                    <div class="card-name">
                        <span class="label label-primary">{{ $card['category']['name'] }}</span>                        

                        <h2 class="">{{ $card->business_name }}</h2>
                        <p class="keywords">{{ $card->keywords }}</p>

                        <div class="card-contact">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-success">
                            @else
                                <a href="tel:{{ $card['contact_primary'] }}" class="btn btn-primary">
                            @endguest

                                <i class="fa fa-phone"></i> {{  str_repeat("*", 6) . substr($card['contact_primary'], 4) }}
                            </a>            

                            <a href="tel:{{ $card['email_address'] }}" class="btn btn-primary">
                                <i class="fa fa-envelope"></i> {{ $card->email_address }} 
                            </a>
                        </div>
                        
                        
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="map-wrapper">
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
                    
                    <div class="col-12 col-xl-7 align-self-center order-xl-2 order-1 text-xl-right">
<ul class="list-inline">
                                
                                <li class="list-inline-item py-2 mr-0"><a href="#" class="lis-light"><i class="fa fa-heart-o pr-1"></i> Favorite</a> </li>
                                <li class="list-inline-item py-2 mr-0"><a href="#" class="lis-light rounded-left"><i class="fa fa-share-alt pr-1"></i> Share</a> </li>
                            </ul>

                        {{ $card->description }}

                        <li>
                            {{ $card->business_person }} <i class="fa fa-user-o"></i>
                        </li>

                        <div class="card-social col-md-12">
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