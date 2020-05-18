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
        <a href="{{ route('admin.cards.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>


  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Cardbiz Search</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>Search Text</th>
                  <th>Last Used</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($searchInfo as $sRow)
                    <tr>
                      <td>{{ $sRow->search_text }}</td>
                      <td>{{ $sRow->updated }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
      </div>
    </div>
  </div>
  
  @endsection