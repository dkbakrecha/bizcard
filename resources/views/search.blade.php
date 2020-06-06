@extends('layouts.site.app')

@section('content')

<div class="search-filter bg-background">
    <div class="container">
         <form action="{{ route('list') }}" method="get" class="form biz-form home-search" id="filter-form">
            <div class="input-append">
              <input class="search-text bizsearch" type="text" placeholder="Type your keyword" name="q" value="{{ __($searchTerm) }}">

                <div class="filter-select">

                <select name="c" id="filter-category">
                    <option value="">Business Category</option>

                    @foreach ($bizCategory as $cate)
                        <option value="{{ $cate->slug }}" {{ ($cate->slug == $filterCategory)?"selected":"" }}>{{ $cate->name }}</option>
                    @endforeach
                </select>
                </div>

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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-search"></span> Sorry, no results were found.
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Check your spelling</li>
                        <li>Try changing the words in your search</li>
                        <li>Try making your words less specific</li>
                    </ul>
                    <div class="alert alert-info">
                        Currently there are no business found for your search criteria.
                    </div>
                </div>
            </div>
        </div>
        
        @endif 
    </div>    

    <div class="pagination-wrapper">
        {{ $cardData->links() }}
    </div>
</div>
@endsection




@section('page-js-script')
<script type="text/javascript">
    $( "#filter-category" ).change(function() {
      $("#filter-form").submit();
    });
</script>
@endsection