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
                    My Contacts
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                Contact
                            </th>
                            <th colspan="2" class="center">
                                Action
                            </th>
                        </tr>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>
                                {{ $contact['card']['business_name'] }}
                                ( {{ $contact['card']['business_person'] }} )
                            </td>

                            <td class="center">
                                <a href="{{ url('card/' . $contact['card']['slug']) }}" title="{{ $contact['card']['business_name'] }}" rel="bookmark" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td class="center">
                                <a href="tel:{{ $contact['card']['contact_primary'] }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-phone"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-biz">Add Contact</button>
                </div>    
            </div>
        </div>
    </div>

</div>


@endsection