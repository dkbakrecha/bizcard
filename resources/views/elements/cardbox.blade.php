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
        </div>
    </div>
    <div class="panel-footer">
            <div class="btn-group" role="group">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-success">
                @else
                    <a href="tel:{{ $card['contact_primary'] }}" class="btn btn-primary">
                @endguest

                    <i class="fa fa-phone"></i> {{  str_repeat("*", 6) . substr($card['contact_primary'], 4) }}
                </a>        


                @guest
                    <a href="{{ route('login') }}" class="btn btn-default">
                @else
                    <a href="#" class="btn btn-primary btn-block">
                @endguest

                    <i class="fa fa-heart-o"></i> Favorite
                </a>
            </div>
        
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