@extends('layouts.site.app')

@section('content')
@include('elements.messages')

<style>
    .biz-search{
        background: linear-gradient(86deg, rgba(0, 0, 0, 0.8) 0%, rgba(28, 70, 197, .9) 100%), url('{{ asset('images/banner.jpg') }}');
        background-size: cover;
        color: #fff;
        padding: 80px 0;
    }
    .section-resent-rooms, .biz-home-add-listing{
        background: url('{{ asset('images/bg-jodhpur.jpg') }}');
        padding: 20px 0;
    }
</style>

<section class="section-front biz-search center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <h2 id="changethewords"><strong>Find Local 
                      <span class="text-green" data-id="1">Business</span>
                      <span class="text-turquoise" data-id="2">Health Services</span>
                      <span class="text-blue" data-id="3">It Services</span>
                      <span class="text-orange" data-id="4">Education Places</span>
                      <span class="text-peach" data-id="5">Shopping Store</span>
                      <span class="text-maroon" data-id="6">Sports Club</span>
                      <span class="text-mango" data-id="7">Travel Places</span>
                </strong></h2>
              <p> All the best businesses, professionals, and service providers are waiting for your call</p>
              <form action="{{ route('list') }}" method="get" class="form biz-form home-search">
                <div class="input-append">
                  <input class="search-text" type="text" placeholder="Type your keyword" name="q" required>
                  <button class="btn btn-biz" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
              </form>
            </div>
            
        </div>    
    </div>
</section>

<section class="section-front biz-resentbiz">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <h2 class="section-heading">{{ __('Resent added business') }}</h2>
            </div>
            <div class="col-lg-6 col-md-4 no-mobile">
                <a href="{{ route('list') }}" class="btn btn-biz pull-right">View All</a>
            </div>
        </div>
        
        
        
        <div class="row search-row">
            
               @if(!empty($resentCards))

               @foreach ($resentCards as $card)

                <div class="col-md-4">
                    @include('elements.cardbox')
                </div>
            @endforeach 
            <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                
            </div>
            @endif 
        </div>    
    </div>
</section>

<section class="category">
    <h3 class="section-title">Popular Category</h3>

    <div class="container clear-mob-pd">
        <div class="col-lg-12 clear-mob-pd">
                <div class="category-bx center">
                    <div class="row clear-mob-pd">

                        @foreach ($bizCategory as $cate)
                            <a href="{{ route('list') }}/?c={{ $cate->slug }}" class="category">
                                <i class="fa {{ $cate->icon }}"></i>
                                <p>{{ $cate->name }}</p>
                            </a>
                        @endforeach
                        
                </div>
            </div>
    </div>
</section>

<?php
/* 
<section class="section-front biz-resentitem" style="display: none;">
    <div class="container">
        <h2 class="section-heading">{{ __('Resent added items') }}</h2>

        <div class="row search-row">
            
               @if(!empty($resentItems))

               @foreach ($resentItems as $item)

                <div class="col-md-3 col-xs-6">
                    <div class="panel panel-success card">
                        <div class="panel-body flow">
                            <a href="{{ route('product.show', $item->id) }}" title="{{ $item['item_name'] }}" rel="bookmark">
                                <img id="blah" src="{{URL::to('/')}}/images/items/{{$item->image}}" alt="your image" class="img-responsive" />
                            </a>
                            <h2 class="business-name">
                                {{ $item['item_name'] }}
                            </h2>

                            <div>
                                {{ $item->price }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 

            <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                <a href="{{ route('marketplace') }}" class="btn btn-biz btn-block">Explorer Marketplace</a>
            </div>
            @endif 
        </div>    
    </div>
</section>

*/
?>


<?php /* 
<section class="section-front biz-home-add-listing">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 no-mobile">
                <img src="">
            </div>
            <div class="col-lg-6">
              <h2><strong>Your business needs, met <span class="colored">Opt in form</span></strong></h2>
              <p>Be inspired to achieve more, get on top of every business challenge today</p>
                  <a href="{{ route('card.create') }}" class="btn btn-biz">Add Listing</a>
              </div>
        </div>    
    </div>
</section>
*/?>





<?php /*

<div class="section-resent-rooms">
    <div class="container">
        <h2 class="section-title">Recent Properties</h2>
        <div class="row" id="resentRoom">
            <?php
            if (!empty($roomList)) {
                foreach ($roomList as $room) {
                    ?>
                    <div class="room recent">
                        <div class="thumbnail">
                            <?php if (!empty($room['Room']['price'])) { ?>
                                <span class="badge blue pull-right room-rate">
                                    <?php echo $room['Room']['price']; ?>
                                </span>
                            <?php } ?>
                            <?php
                            $_filename = 'uploads/' . $room['Room']['id'] . '_room.png';

                            if (file_exists(WWW_ROOT . 'img/' . $_filename)) {
                                echo $this->Html->image($_filename, array('class' => 'img-responsive'));
                            } else {
                                echo $this->Html->image('no_image.png');
                            }
                            ?>
                            <div class="caption">
                                <?php
                                $_room_for = "For Rent";
                                $_forcolor = "turquoise";
                                if ($room['Room']['list_for'] == 1) {
                                    $_room_for = "For Sale";
                                    $_forcolor = "red";
                                }
                                ?>
                                <span class="badge <?php echo $_forcolor; ?> pull-right room-for">
                                    <?php echo $_room_for; ?>
                                </span>

                                <a href="<?php echo $this->Html->url(array('controller' => 'rooms', 'action' => 'detail', $room['Room']['id'])); ?>">
                                    <?php echo $this->General->short_msg($room['Room']['title'], 25); ?>
                                </a>
                                
                                <span><?php echo $room['Room']['address']; ?></span>

                                <div class="room-metas">
                                    <ul class="feature-info">
                                        <?php if (!empty($room['Room']['beds'])) { ?>
                                            <li><?php echo $this->Html->image('rs_icons/bed.png'); ?> <span><?php echo $room['Room']['beds']; ?></span>
                                            </li>
                                        <?php } ?>

                                        <?php if (!empty($room['Room']['baths'])) { ?>
                                            <li><?php echo $this->Html->image('rs_icons/bathtub.png'); ?> <span><?php echo $room['Room']['baths']; ?></span>
                                            </li>
                                        <?php } ?>

                                        <?php if (!empty($room['Room']['area'])) { ?>
                                            <li>Area<span><?php echo $room['Room']['area']; ?> sqft</span>
                                            </li>
                                        <?php } ?>
                                    </ul>

                                    <ul class="wishlist-compare-wrapper">
                                        <li>
                                            <a class="gl-add-wishlist tip-attached" href="#" title="Add to wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="gl-add-compare tip-attached" href="#" title="Add to Compare">
                                                <i class="fa fa-book">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>


<div class="section-services">
    <div class="container">
        <h2 class="section-title">Some <span>good</span> reasons</h2>
        <div class="row" id="homeServices">
            <div class="col-lg-6">
                <div class="servicebox">
                <h3>Genuine listing</h3>
                <p>Room247.in has been created considering our valuable room seekers. Each single listing you will see on our website is genuine. We collect the best correct possible information for the room they advertise and bring it to your screen. We have used standard advanced search methods, which help seekers find the rooms with all the facilities mentioned and in the minimum possible time.</p>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="servicebox">
                <h3>Visual Analysis</h3>
                <p>We have used the HD images and videos for the rooms which helps seekers to see each single corner of the room and the facilities that house holders provide. Room247.in believes that the kind of service if the seekers expect from us we should concentrate on that not on the flashy designs. Room247.in has been crafted to deliver the best possible information along with the detailed visuals.</p>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="servicebox">
                <h3>Customer service</h3>
                <p>Room247.in has a tremendous customer service. We are continuously striving hard to reach improve and to broaden our customers service using various mediums. You can contact us via Skype, Facebook, Twitter, Watsapp, Google App, Email and of course via the numbers given. We value your time and thatswhy we are happy to assist you.</p>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="servicebox">
                <h3>One to one</h3>
                <p>We have shorten the distance between owners and the room seekers. If seekers wants to contact they can contact owners using chat function and they can also call them. Seekers also contact using Facebook.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <hr>
            <div class="col-md-8 col-sm-6 hidden-xs">
                <?php echo $this->Html->image('room-image.png'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <h3><span>Get started</span> with Room247.in</h3>
                <p>
                    Room247.in is an endeavor for our esteemed room seekers who are looking for their “Ashiyana”.
                </p>
                <ul class="list_order">
                    <li><span>1</span>Select your preferred tours</li>
                    <li><span>2</span>Purchase tickets and options</li>
                    <li><span>3</span>Pick them directly from your office</li>
                </ul>
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register')); ?>" class="btn btn-primary btn-lg green">Start now</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('document').ready(function () {
        $('#RoomSearchteam').keyup(function () {
            var _term = $(this).val();
            if (_term == "") {
                $("#display_search").html("");
            } else {
                $.ajax({
                    url: '<?php echo $this->Html->url(array("controller" => "rooms", "action" => "searchterm"), true); ?>',
                    type: "GET",
                    data: {term: _term},
                    success: function (data) {
                        $("#display_search").html(data);
                    },
                    error: function (xhr) {
                        ajaxErrorCallback(xhr);
                    }
                });
            }
        });


    });

    function submitFilter(term) {
        $('#RoomSearchteam').val(term);
        $('#RoomListingForm').submit();
    }
</script>

*/ ?>  
@endsection