@extends('layouts.site.app')

@section('content')

<div class="container">
    <div class="col-lg-3">
            @include('layouts.site.sidebar_user')
        </div>
        <div class="col-lg-9 margin-tb">
            <div class="pull-left">
                <h2>Items List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('items.create') }}">Add</a>
            </div>


            <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->item_name }}</td>
        <td>{{ $item->price }}</td>
        <td><img id="blah" src="{{URL::to('/')}}/images/items/{{$item->image}}" width="50"/></td>
        <td>
            <a class="btn btn-info" href="#">Show</a>
            <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}">Edit</a>
            <form action="#" method="POST">

                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
    </table> 
    {!! $items->render() !!}
        </div>
    
    
    
</div>
@endsection