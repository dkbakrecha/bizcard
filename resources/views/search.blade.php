@extends('layouts.site.app')

@section('content')
<div class="container">
    <h1>{{ __($searchTerm) }}</h1>

    <div class="row search-row">
        
           @if(!empty($cardData))

           @foreach ($cardData as $card)

            <div class="col-md-4">
            <div class="panel panel-default card">
            <div class="panel-body flow">
                        <div class="search-info">
                            <span class="label label-primary">{{ $card['category']['name'] }}</span>
                            <!--TO DO if Business Contact number is verified -->                            
                            <span class="label label-success"><i class="fa fa-check"></i> Verified</span>

                            <!--TO DO Mark as feverate -->
                            <a href="#" class="btn btn-primary pull-right">
                                <i class="fa fa-heart-o"></i>
                            </a>

                            <h2 class="business-name">
                                <a href="{{ url('card/' . $card['slug']) }}" title="{{ $card['business_name'] }}" rel="bookmark">
                                    {{ $card['business_name'] }}
                                </a>
                            </h2>

                            <div>
                                {{ $card['address'] }}
                                {{ $card['contact_primary'] }}
                            </div>
                        </div>
                    
            </div>
            <div class="panel-footer">
                <a href="tel:{{ $card['contact_primary'] }}" class="btn btn-primary">
                    <i class="fa fa-phone"></i>
                </a>

                <!--TO DO if permission to whatapp message -->
                <a href="https://wa.me/91{{ $card['contact_primary'] }}" class="btn btn-primary">
                    <i class="fa fa-whatsapp"></i>
                </a>

                <!--TO DO if Proper lat lang is available -->
                <a href="#" class="btn btn-primary">
                    <i class="fa fa-map-o"></i>
                </a>                

                <!--TO DO Enquery(LEAD) FORM -->
                <a href="#" class="btn btn-primary pull-right">
                    <i class="fa fa-envelope-o"></i> Get Best Deal
                </a>

                <!-- Share contact open -->
            </div>
        </div>
        </div>
        @endforeach 

        @else
        <div class="no-search-message">
            <h3> Currently there are no business found for your search criteria. </h3>
        </div>
        @endif 
</div>    
</div>




<!-- Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('messages.staff_info') }}</h4>
            </div>
            <form action="{{ route('users.update','test') }}" method="post" class="form-horizontal" id="customerEditForm">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    @include('provider.staff.view')
                </div>   
            </form>
        </div>
    </div>
</div> 
@endsection