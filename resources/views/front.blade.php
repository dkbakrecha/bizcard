@extends('layouts.site.app')

@section('content')
@include('elements.messages')

<style>
    .section-resent-rooms, .biz-search, .biz-home-add-listing{
        background: url('{{ asset('images/bg-jodhpur.jpg') }}');
    }
</style>

<section class="biz-search">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
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
              <form action="{{ route('search') }}" method="get" class="form biz-form home-search">
                <div class="input-append">
                  <input class="search-text" type="text" placeholder="Type your keyword" name="q">
                  <button class="btn btn-biz" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
              </form>
            </div>
            <div class="col-lg-6 no-mobile">
                <img src="">
            </div>
        </div>    
    </div>
</section>

<section class="biz-home-add-listing">
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

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        


        $('.servicebox_tik').on('ifChanged', function (event) {
            var totalPrice = 0;

            $('input[name="services[]"]:checked').each(function () {
                var _sprice = $(this).data('price');
                totalPrice = totalPrice + _sprice;
            });
            $("#price").val(totalPrice);
        });

        $('#viewCustomerModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var _id = button.data('id');

            var modal = $(this)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ url('/viewCustomer') }}",
                method: 'POST',
                data: {id: _id},
                success: function (result) {
                    modal.find('.modal-body #id').val(result.data.id);
                    modal.find('.modal-body #unique_id').val(result.data.unique_id);
                    modal.find('.modal-body #name').val(result.data.name);
                    modal.find('.modal-body #email').val(result.data.email);
                    modal.find('.modal-body #phone').val(result.data.phone);

                    modal.find('.modal-body #address').val(result.data.address);

                    modal.find('.modal-body input:radio[name=gender]').filter('[value="' + result.data.gender + '"]').iCheck('check');

                    modal.find('.modal-footer .block_customer').attr('data-id', result.data.id);
                    if (result.data.area != null) {
                        modal.find('.modal-body #area').val(result.data.area.name);
                    }



                }
            });
        });

        $('#viewBookingModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var _id = button.data('id');

            var modal = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('getBooking') }}",
                method: 'post',
                data: {id: _id},
                success: function (result) {
                    //console.log(result.data);
                    modal.find('.modal-body #id').val(result.data.id);
                    modal.find('.modal-body #unique_id').val(result.data.unique_id);
                    modal.find('.modal-body #username').val(result.data.customer.name);
                    modal.find('.modal-body #booking_date').val(result.data.booking_date);
                    modal.find('.modal-body #booking_time').val(result.data.booking_starttime);
                    modal.find('.modal-body #service_provider').val(result.data.shop.name);
                    modal.find('.modal-body #payment').val(result.data.final_amount);
                    modal.find('.modal-body #services').val(result.services);
                    modal.find('.modal-body #staff').val(result.barber);

                    modal.find('.modal-body #payment_method').val(result.data.payment_method);
                    modal.find('.modal-body .label-primary').removeClass().addClass("label label-primary " + result.data.booking_class);
                    modal.find('.modal-body .label-primary').html(result.data.booking_status);


                }
            });
        });
    });
</script>
@endsection