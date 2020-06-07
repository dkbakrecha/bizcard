<div class="card-wrap">
    
<div class="item-card-img">
    <div class="ribbon ribbon-top-left text-danger"><span class="bg-danger">New</span></div>

@if(file_exists( public_path().'/images/cards/'.$card['id'].'-'.$card['slug'].'.jpg' ))
    <img src="{{ asset('public/images/cards/'.$card['id'] .'-'. $card['slug'] .'.jpg') }}" class="img-responsive">
@endif
</div>
    
<div class="panel panel-default card business">
    <div class="panel-body flow">
        <span class="label label-primary pull-rig">{{ $card['category']['name'] }}</span>
        <h2 class="business-name">
            <a href="{{ url('card/' . $card['slug']) }}" title="{{ $card['business_name'] }}" rel="bookmark">
                {{ $card['business_name'] }}
            </a>
        </h2>
        <div class="address">
            {{ $card['address'] }}
            <div>
                
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <a href="tel:{{ $card['contact_primary'] }}" class="pull-right">
        @guest
            <i class="fa fa-phone"></i> {{  str_repeat("*", 6) . substr($card['contact_primary'], 4) }}
        @else
            <i class="fa fa-phone"></i> {{ $card['contact_primary'] }}
        @endguest
        </a>

                @guest
                    <span data-toggle="modal" data-target="#loginModal" class="btn  btn-primary add-to-contact">
                @else
                    <span class="btn btn-primary add-to-contact" data-id="{{ $card['id'] }}">
                @endguest

                    @if(count($card['contact']) > 0)
                        <i class="fa fa-heart"></i> Saved
                    @else
                        <i class="fa fa-heart-o"></i> Save
                    @endif


                </span>

                <a href="{{ url('card/' . $card['slug']) }}" title="{{ $card['business_name'] }}" class="btn btn-primary">
                    View
                </a>
        
        <?php
        /*
        <!--TO DO if Business Contact number is verified -->                            
                    <span class="label label-success"><i class="fa fa-check"></i> Verified</span> 

        <!--TO DO Enquery(LEAD) FORM -->
                <a href="#" class="btn btn-primary btn-block">
                    <i class="fa fa-envelope-o"></i> Get Best Deal
                </a>        

        <!--TO DO if permission to whatapp message -->
        <a href="https://wa.me/91{{ $card['contact_primary'] }}" class="btn btn-primary">
            <i class="fa fa-whatsapp"></i>
        </a>

        <!--TO DO if Proper lat lang is available -->
        <a href="#" class="btn btn-primary">
            <i class="fa fa-map-o"></i>
        </a>        
        */
        ?>

        <!-- Share contact open -->
    </div>
</div>    

</div>