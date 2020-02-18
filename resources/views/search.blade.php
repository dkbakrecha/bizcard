@extends('layouts.site.app')

@section('content')
<div class="container">
    <h1>{{ __($searchTerm) }}</h1>

    <div class="row search-row">
        
        @if(!empty($cardData))

            @foreach ($cardData as $card)
            <div class="col-md-4">
                @include('elements.cardbox')
            </div>
            @endforeach 

        @else
        <div class="no-search-message">
            <h3> Currently there are no business found for your search criteria. </h3>
        </div>
        @endif 
    </div>    
</div>
@endsection