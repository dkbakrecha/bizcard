@extends('layouts.site.app')

@section('content')
@include('elements.messages')


<div class="hr-line"></div>
<?php

$userData = Auth::guard('web')->user();

//$userData['User']['first_name'] = "Dharmendra";
//$userData['User']['last_name'] = "Bagrecha";
//$userData['User']['email'] = "dkbakrecha@gmail.com";
//pr($userData);
//pr($userRooms);
?>
<div class="container" id="roomContent">


    <div class="row">
        <div class="col-lg-3">
            @include('layouts.site.sidebar_user')

             <div class="panel panel-default dashboard hide">
                <div class="panel-title">
                    Tips
                </div>
                <div class="panel-body">
                    For any suggestion direct chat with admin support
                </div>
              </div>
        </div>

        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-home"></span> Welcome, We're glad you're here!
                </div>
                <form action="{{ route('updateinfo') }}" method="post" class="form-horizontal"  enctype="multipart/form-data">

                    {{ csrf_field() }}
                    @php 
                    $userInfo = Auth::guard('web')->user();
                    $currentUser =  DB::table('users')->where('id', '=', $userInfo->id)->first();
                    //echo "<pre>";
                    //print_r($currentUser);
                    //echo "</pre>";
                    $_updateSetting = 1;
                    @endphp
                    <div class="panel-body">

                        
                        @if(empty($currentUser->name))
                        <h3 class="sub-heading text-center">Tell us a little about yourself.</h3>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">{{ __('messages.name') }}</label>

                            <div class="col-sm-5">
                                <input type="hidden" name="fieldtype" value="name">
                                <input id="name" type="text" placeholder="{{ __('Full Name') }}" class="form-control" name="name" value="{{ (!empty($currentUser->name))?$currentUser->name:"" }}" required>
                            </div>
                        </div>
                        @elseif(empty($currentUser->area_id))
                        <h3 class="sub-heading text-center">Tell us a little about your area.</h3>

                        <div class="form-group">
                            <label for="business_area" class="col-md-4 control-label">Area :</label>
                            <div class="col-sm-5">
                                <input type="hidden" name="fieldtype" value="area">
                                <select name="area_id" id="area_id" class="form-control" required>
                                  <option value="">Select Area</option>
                                  @foreach ($bizArea as $area)
                                      <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        @else
                        @php $_updateSetting = 0; @endphp
                        <h3 class="sub-heading text-center">Setup your free business profile here</h3>

                        <div class="btn-submitproperties">
                            <a href="{{ route('card.create') }}">
                                <span id="subup"><i class="fa fa-briefcase"></i></span>
                                <span id="subct">Free Business Profile</span>
                            </a>
                        </div>
                        @endif                        
                    </div>
                    @if($_updateSetting == 1)
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-biz">{{ __('messages.save_changes') }}</button>
                    </div> 
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection