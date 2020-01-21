@extends('layouts.site.app')

@section('content')
    
    @php 
        $cateImgArr = array('1' => 'automotive.png', '2' => 'business.png', '3' => 'education.png', '4' => 'food.png', '5' => 'health.png', '6' => 'it.png', '7' => 'shop.png', '8' => 'sport.png', '9' => 'travel.png');

        /*  <img src="{{ asset('/images/' . $cateImgArr[$card->business_category]) }}" class="img-responsive logo-card" alt="">
                        */
    @endphp

<section class="card-top blue noisy">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 card-inner-wrap">
                    <div class="card-name">
                        

                        <h2 class="">{{ $card->business_name }}</h2>
                        <p class="keywords">{{ $card->keywords }}</p>
                    </div>
                    
                    <ul class="list-unstyled text-right pull-right">
                        <li>
                            {{ $card->business_person }} <i class="fa fa-user-o"></i>
                        </li>
                        <li>
                            {{ $card->contact_primary }} <i class="fa fa-phone"></i>
                        </li>
                        <li>
                            {{ $card->email_address }} <i class="fa fa-envelope"></i>
                        </li>
                        <li>
                            {{ $card->address }} <i class="fa fa-map-o"></i>
                        </li>
                    </ul>    

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
                            
                            <ul class="list-inline pull-right">
                                
                                <li class="list-inline-item py-2 mr-0"><a href="#" class="lis-light"><i class="fa fa-heart-o pr-1"></i> Favorite</a> </li>
                                <li class="list-inline-item py-2 mr-0"><a href="#" class="lis-light rounded-left"><i class="fa fa-share-alt pr-1"></i> Share</a> </li>
                            </ul>
                    </div>
            </div>
        </div>
    </div>
</section>


<div class="profile-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-10 col-xl-5 order-xl-1 order-2 text-xl-right text-center">
                        <ul class="nav nav-pills flex-column flex-sm-row lis-font-poppins" id="myTab" role="tablist">
                            <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative mr-3 active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="true"> About</a> </li>
                            <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative mr-3" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"> Product</a> </li>
                            <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative mr-3" data-toggle="tab" href="#events" role="tab" aria-controls="events">Review</a> </li>
                            <li class="nav-item ml-0"> <a class="nav-link lis-light py-4 lis-relative" data-toggle="tab" href="#booking" role="tab" aria-controls="booking"> Gallery</a> </li>
                        </ul>
                    </div>
                    <div class="col-12 col-xl-7 align-self-center order-xl-2 order-1 text-xl-right text-center ">
                        {{ $card->description }}
                    </div>
                </div>
            </div>
        </div>

@endsection