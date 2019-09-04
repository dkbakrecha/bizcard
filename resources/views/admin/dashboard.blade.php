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
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">

            <div class="info-box-title">
                <h4>{{ __('messages.total_users') }}</h4>
            </div>
            <div class="info-box-content">
                <div class="info-block">
                    <span class="info-box-number">{{ $customer }}</span>

                    @if ($getUserPrev10Days > 0)

                    @if($user_percentage > 0)
                    <span class="info-box-description text-green">
                        <i class="fa fa-arrow-up"></i>
                        {{ $user_percentage }}%
                    </span>
                    @else
                    <span class="info-box-description text-danger">
                        <i class="fa fa-arrow-down"></i>
                        {{ $user_percentage }}%
                    </span>
                    @endif

                    @endif
                </div>


                <div class="info-box-graph">
                    <div class="sparkbar pad" data-color="#55D8FE" data-width="9">{{ $dates }}</div>
                </div>
            </div>
        </div>
    </div>
   
 
</div>

<div class="row">
    <div class="col-md-12 graph-content">
        <div class="panel panel-default">
            <div class="row dash-graph-header">
                <div class="col-xs-7 col-sm-8 col-md-9 col-lg-10 pull-left">
                    <div class="panel-heading">
                        <h3>{{ __('messages.user_statistics') }}</h3>
                    </div>
                </div>

                <div class="col-xs-5 col-sm-4 col-md-3 col-lg-2 pull-right">
                    <select name="userChartStats" id="userChartStats" class="form-control filter pull-right">
                        <option value="currentMonth">{{ __('messages.current_month') }}</option>
                        <option value="lastMonth">{{ __('messages.last_month') }}</option>
                        <option value="last6Months">{{ __('messages.last_6_month') }}</option>
                        <option value="last1Year">{{ __('messages.last_year') }}</option>
                    </select>
                </div>
            </div>

            <div class="panel-body">
                <div class="chart tab-pane active" id="user-statistics-chart" style="position: relative; height: 300px;">
                </div>
                <div class="shapes">
                    <div>
                        <div class="rectangle-two">
                        </div>
                        <span>{{ __('messages.users') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 graph-content">
        <div class="panel panel-default">
            <div class="row dash-graph-header">
                <div class="col-xs-7 col-sm-8 col-md-9 col-lg-10 pull-left">
                    <div class="panel-heading">
                        <h3> {{ __('messages.booking_statistics') }}</h3>
                    </div>
                </div>

                <div class="col-xs-5 col-sm-4 col-md-3 col-lg-2  pull-right">
                    <select name="bookingChartStats" id="bookingChartStats" class="form-control">
                        <option value="currentMonth">{{ __('messages.current_month') }}</option>
                        <option value="lastMonth">{{ __('messages.last_month') }}</option>
                        <option value="last6Months">{{ __('messages.last_6_month') }}</option>
                        <option value="last1Year">{{ __('messages.last_year') }}</option>
                    </select>
                </div>
            </div>
            <div class="panel-body">
                <div class="chart tab-pane active" id="bookings-statistics-chart" style="position: relative; height: 300px;">
                </div>
                <div class="shapes">
                    <div>
                        <div class="rectangle-one">
                        </div>
                        <span>{{ __('messages.bookings') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection