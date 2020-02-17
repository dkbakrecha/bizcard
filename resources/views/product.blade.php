@extends('layouts.site.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img id="blah" src="{{URL::to('/')}}/images/items/{{$item->image}}" alt="your image" class="img-responsive" />
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <h1>{{ $item['item_name'] }}</h1>

                <p class="description">
                   {{ $item['description'] }}
                </p>
                <h2 class="product-price">{{ $item->price }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection