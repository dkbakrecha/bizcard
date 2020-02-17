@extends('layouts.site.app')

@section('content')
<div class="container">
    <div class="row search-row">
    
    @if(!empty($itemData))

       @foreach ($itemData as $item)

        <div class="col-md-3 col-xs-6">
            <div class="panel panel-success card">
                <div class="panel-body flow">
                    <a href="{{ route('product.show', $item->id) }}" title="{{ $item['item_name'] }}" rel="bookmark">
                        <img id="blah" src="{{URL::to('/')}}/images/items/{{$item->image}}" alt="your image" class="img-responsive" />
                    </a>
                    <h2 class="business-name">
                        {{ $item['item_name'] }}
                    </h2>

                    <div>
                        {{ $item->price }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach 
    
    @endif     
          
    </div>    
</div>
@endsection