@extends('admin.layouts.app')


@section('content')
@include('elements.messages')

<div class="container" id="roomContent">
  <div class="row">
    <div class="col-lg-7">
      <div class="panel panel-default dashboard">
        <div class="panel-title">
          Card Profile
          @if(!empty($cardData->slug))
          <a href="{{ url('card/' . $cardData->slug) }}" class="pull-right" target="_BLANK">View Card</a>
          @endif
        </div>
        <form method="post" action="{{ route('admin.cards.update',$cardData->id) }}">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}

          <div class="panel-body">

            @csrf


            <div class="form-group middle">
              <label for="business_person">Business Category :</label>
              <select name="business_category" id="business_category" class="form-control">

                @foreach ($categoryList as $category)

                {{ $_chk = "" }}
                @if(!empty($cardData->business_category) && $category->id == $cardData->business_category)
                @php ($_chk = "selected")
                @endif
                <option value="{{ $category->id }}" {{ $_chk }}>{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group middle">
              <label for="business_area">Area :</label>
              <select name="area_id" id="area_id" class="form-control">
                <option value="" {{ $_chk }}>Select Area</option>
                @foreach ($bizArea as $area)

                {{ $_chk = "" }}
                @if(!empty($cardData->area_id) && $area->id == $cardData->area_id)
                @php ($_chk = "selected")
                @endif
                <option value="{{ $area->id }}" {{ $_chk }}>{{ $area->area_name }}</option>
                @endforeach
              </select>
            </div>

            
            <div class="form-group">
              <label for="business_name">Business Name:</label>
              <input type="text" class="form-control" name="business_name" value="{{ (!empty($cardData->business_name)?$cardData->business_name:"") }}"/>
            </div>
            <div class="form-group">
              <label for="business_person">Business Person :</label>
              <input type="text" class="form-control" name="business_person" value="{{ (!empty($cardData->business_person))?$cardData->business_person:"" }}"/>
            </div>

            <div class="form-group">
              <label for="user_id">User ID :</label>
              <input type="text" class="form-control" name="user_id" value="{{ (!empty($cardData->user_id))?$cardData->user_id:"" }}"/>
            </div>

            <div>

              <!-- Tab panes -->
              <div class="tab-content">

                <div>
                  <div class="form-group">
                    <label for="address">Address :</label>
                    <input type="text" class="form-control" name="address" value="{{ (!empty($cardData->address))?$cardData->address:"" }}"/>
                  </div>
                  <div class="form-group">
                    <label for="email_address">Email :</label>
                    <input type="text" class="form-control" name="email_address" value="{{ (!empty($cardData->email_address))?$cardData->email_address:"" }}"/>
                  </div>
                  <div class="form-group">
                    <label for="contact_primary">Contact Primary :</label>
                    <input type="text" class="form-control" name="contact_primary" value="{{ (!empty($cardData->contact_primary))?$cardData->contact_primary:"" }}"/>
                  </div>
                  <div class="form-group">
                    <label for="contact_secondary">Contact Secondary :</label>
                    <input type="text" class="form-control" name="contact_secondary" value="{{ (!empty($cardData->contact_secondary))?$cardData->contact_secondary:"" }}"/>
                  </div>      
                </div>
                <div >
                  <div class="form-group">
                    <label for="description">Description :</label>
                    <input type="text" class="form-control" name="description" value="{{ (!empty($cardData->description))?$cardData->description:"" }}"/>
                  </div>
                  <div class="form-group">
                    <label for="keywords">Keywords :</label>
                    <input type="text" class="form-control" name="keywords" value="{{ (!empty($cardData->keywords))?$cardData->keywords:"" }}"/>
                  </div>
                </div>
                <div>
                  <div class="form-group">
                    <label for="facebook">Facebook :</label>
                    <input type="text" class="form-control" name="facebook" value="{{ (!empty($cardData->facebook))?$cardData->facebook:"" }}"/>
                  </div>
                  <div class="form-group">
                    <label for="instagram">Instagram :</label>
                    <input type="text" class="form-control" name="instagram" value="{{ (!empty($cardData->instagram))?$cardData->instagram:"" }}"/>
                  </div>
                  <div class="form-group">
                    <label for="linkedin">Linked In :</label>
                    <input type="text" class="form-control" name="linkedin" value="{{ (!empty($cardData->linkedin))?$cardData->linkedin:"" }}"/>
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter :</label>
                    <input type="text" class="form-control" name="twitter" value="{{ (!empty($cardData->twitter))?$cardData->twitter:"" }}"/>
                  </div>
                </div>
              </div>
            </div>



            <button type="submit" class="btn btn-primary">Update Card Info</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection