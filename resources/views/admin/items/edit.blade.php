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
    <form method="post" action="{{ route('admin.items.update',$item->id) }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Item Name:</strong>
                <input type="text" class="form-control" name="item_name" value="{{ (!empty($item->item_name))?$item->item_name:"" }}"/>
            </div>
        </div>
 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="text" class="form-control" name="price" value="{{ (!empty($item->price))?$item->price:"" }}"/>
            </div>
        </div>
 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                 <input type="text" class="form-control" name="description" value="{{ (!empty($item->description))?$item->description:"" }}"/>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
               
               <input type="file" id="image" name="image" class="form-control" onchange='document.getElementById("blah").src = window.URL.createObjectURL(this.files[0])'>
            </div>
            <img id="blah" src="#" alt="your image" width="150"/>
        </div>

        <div class="form-group middle">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
                <option value="">Select status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>  
          </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection