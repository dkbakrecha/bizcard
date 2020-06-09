@extends('layouts.site.app')

@section('content')
@include('elements.messages')


<div class="hr-line"></div>
<?php
$userData = Auth::guard('web')->user();
?>
<div class="container" id="roomContent">


    <div class="row">
        <div class="col-lg-3">
            @include('layouts.site.sidebar_user')
        </div>


        <div class="col-lg-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-address-card"></span> My Business Contacts
                </div>
                <div class="panel-body">
                    <div class="alert alert-info ">
                        You can add business contacts here by clicking on "Save" button on card search/detail page. You can notify by mail if any of your contact business having any offers.
                    </div>

                    <ul class="list-group margin-top-20">
                    @foreach($contacts as $contact)
                        <li class="list-group-item">
                                

                                <span class="pull-right">
                                    <a href="{{ url('card/' . $contact['card']['slug']) }}" title="{{ $contact['card']['business_name'] }}" rel="bookmark" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> View
                                    </a>

                                    <a href="tel:{{ $contact['card']['contact_primary'] }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-phone"></i> Call
                                    </a>
                                </span>

                                <strong>{{ $contact['card']['business_name'] }}</strong><br>
                                {{ $contact['card']['contact_primary'] }}
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="panel-footer hide">
                    <button type="button" class="btn btn-biz">Add Contact</button>
                </div>    
            </div>
        </div>
    </div>

</div>


@endsection