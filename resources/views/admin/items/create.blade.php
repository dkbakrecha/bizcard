@extends('admin.layouts.app')


@section('content')
@include('elements.messages')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Item</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.items.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('admin.items.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Item Name:</strong>
                <input type="text" class="form-control" name="item_name" value="{{ (!empty($cardData->item_name))?$cardData->item_name:"" }}"/>
            </div>
        </div>
 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="text" class="form-control" name="price" value="{{ (!empty($cardData->price))?$cardData->price:"" }}"/>
            </div>
        </div>
 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                 <input type="text" class="form-control" name="description" value="{{ (!empty($cardData->description))?$cardData->description:"" }}"/>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
               
               <input type="file" id="image" name="image" class="form-control" onchange='document.getElementById("blah").src = window.URL.createObjectURL(this.files[0])'>
            </div>
            <img id="blah" src="#" alt="your image" width="150"/>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection