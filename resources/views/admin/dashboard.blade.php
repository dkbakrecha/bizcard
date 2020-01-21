@extends('admin.layouts.app')

@section('sectionTitle', __('messages.dashboard'))

@section('content')
<section class="content-header">
    <h1>
        {{ __('messages.overview') }}
    </h1>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <?php /* <p>Welcome Mr./Mst : <strong>{{ Auth::user()->name}}</strong></p>
      <p>Your joined  : {{ Auth::user()->created_at->diffForHumans() }} </p>
      <p>Language : <strong>{{ Auth::user()->is_arabic }}</strong></p>
     */ ?>
</section>

<div class="row">
    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $user_active }}</h3>
              <p>User Registrations ( {{ $user_pending }} )</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $card_active }}</h3>
              <p>Business Card ( {{ $card_pending }} )</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.cards') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

   
 
</div>

@endsection