@extends('layouts.site.app')

@section('content')

@section('sectionTitle', __('messages.settings'))

@include('elements.messages')

<div class="container" id="roomContent">
    <div class="row">
        <div class="col-lg-3">
            @include('layouts.site.sidebar_user')
        </div>
        <div class="col-lg-9">
            <div class="panel">

                <div class="panel-heading">
                    Update Profile
                </div>
            <form action="{{ route('settings.store') }}" method="post" class="form-horizontal"  enctype="multipart/form-data">

        {{ csrf_field() }}
        <div class="panel-body settings-body">
            <div class="row">
                <div class="form-group" >
                    <div class="col-md-4">
                        <div class="pull-right image clearfix">
                            @php 
                            $currentUser = Auth::guard('web')->user(); 
                            //echo "<pre>";
                            //print_r($currentUser);
                            //echo "</pre>";
                            @endphp
                            @if(!empty($currentUser->profile_image))

                            <img src="{{ asset('/images/profile/' . $currentUser->profile_image) }}" width="80px" height="80px" class="img-circle" alt="User Image">
                            @else
                            <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" width="80px" height="80px" class="img-circle" alt="User Image">
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-6">
                        
                        <div class="file-text">
                            <input type="file" id="profile_image" name="profile_image" class="form-control">
                        </div>
                    </div>


                </div>

                <div class="form-group">
            <label for="email" class="col-md-4 control-label">{{ __('messages.email_address') }}</label>

            <div class="col-sm-6">
                <input id="email" type="text" placeholder="{{ __('messages.email_address') }}" class="form-control" name="email" value="{{ (!empty($currentUser->email))?$currentUser->email:"" }}" disabled="">
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-md-4 control-label">{{ __('messages.phone') }}</label>

            <div class="col-sm-6">
                <input id="phone" type="text" placeholder="{{ __('messages.phone') }}" class="form-control" name="phone" value="{{ (!empty($currentUser->phone))?$currentUser->phone:"" }}" disabled="true">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-md-4 control-label">{{ __('messages.name') }}</label>

            <div class="col-sm-6">
                <input id="name" type="text" placeholder="{{ __('messages.name') }}" class="form-control" name="name" value="{{ (!empty($currentUser->name))?$currentUser->name:"" }}">
            </div>
        </div>


            </div>
            
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-biz">{{ __('messages.save_changes') }}</button>
        </div> 
        </div>   
    </form>
        </div>
    </div>
</div>

@endsection