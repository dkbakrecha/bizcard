@extends('layouts.site.app')

@section('content')
<div class="search-filter">
    <div class="container">
         <form action="{{ route('search') }}" method="get" class="form biz-form home-search">
            <div class="input-append">
              <input class="search-text" type="text" placeholder="Type your keyword" name="q" value="{{ __($searchTerm) }}">
              <button class="btn btn-biz" type="submit" style="display: none;">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </form>
    </div>
</div>

<div class="container">
    
    @if(!empty($searchTerm))
        <h1 class="results-header align-left"> Showing results for "{{$searchTerm}}" </h1>    
    @endif

    <div class="row search-row">
        
        @if(!empty($cardData) && $cardData->count() > 0)

            @foreach ($cardData as $card)
            <div class="col-md-4 col-sm-6">
                @include('elements.cardbox')
            </div>
            @endforeach 

        @else
        <div data-v-1f44e63e="" data-v-395857fe="" class="search-alert"><i data-v-1f44e63e="" data-v-395857fe="" class="icon icon_info absolute"></i><div data-v-1f44e63e="" data-v-395857fe="" class="search-alert-text">Sorry, no results were found.</div><ul data-v-1f44e63e="" data-v-395857fe="" class="search-suggestions"><li data-v-1f44e63e="" data-v-395857fe="">Check your spelling</li><li data-v-1f44e63e="" data-v-395857fe="">Try changing the words in your search</li><li data-v-1f44e63e="" data-v-395857fe="">Try making your words less specific</li></ul></div>
        
        <div class="no-search-message">
            <h3> Currently there are no business found for your search criteria. </h3>
        </div>
        @endif 
    </div>    

    <div class="pagination-wrapper">
        {{ $cardData->links() }}
    </div>
</div>
@endsection