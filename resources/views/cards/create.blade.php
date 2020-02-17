@extends('layouts.site.app')

@section('content')
@include('elements.messages')

<div class="container" id="roomContent">
    <div class="row">
      <div class="col-lg-3">
            @include('layouts.site.sidebar_user')


            <div class="panel panel-default dashboard">
                <div class="panel-title">
                    Card status
                </div>
                <div class="panel-body">
                  <ul class="list-unstyled"> 
                    <li> 
                      <i class="fa fa-check text-success" aria-hidden="true"></i>General Information 
                    </li> 
                    <li> 
                      <i class="fa fa-check text-success" aria-hidden="true"></i>Contact Information
                    </li> 
                    <li> 
                      <i class="fa fa-check text-success" aria-hidden="true"></i>Card Description
                    </li> 
                    <li> 
                      <i class="fa fa-check text-success" aria-hidden="true"></i>Social Information
                    </li> 
                  </ul>
                </div>
              </div>
      </div>
        <div class="col-lg-9">
          @if(!empty($cardData) && $cardData->status == 3)

                      <div class="alert alert-info dashboard-top">
                        <strong>Info!</strong> Your Business card in verification process. Once admin team approve that card. It is show globally.
                      </div>
                        
                      @endif

            <div class="panel panel-default dashboard">
                <div class="panel-title">
                    Card Profile
                    @if(!empty($cardData->slug))
                        <a href="{{ url('card/' . $cardData->slug) }}" class="pull-right" target="_BLANK">View Card</a>
                    @endif
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ route('card.store') }}">
                        @csrf
                       
                          <label for="business_person">Business Category :</label>
                                <div class="form-group middle">

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

                                <div class="form-group">
                                    <label for="business_name">Business Name:</label>
                                    <input type="text" class="form-control" name="business_name" value="{{ (!empty($cardData->business_name)?$cardData->business_name:"") }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="business_person">Business Person :</label>
                                    <input type="text" class="form-control" name="business_person" value="{{ (!empty($cardData->business_person))?$cardData->business_person:"" }}"/>
                                </div>

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

<div class="form-group">
                              <label for="description">Description :</label>
                              <input type="text" class="form-control" name="description" value="{{ (!empty($cardData->description))?$cardData->description:"" }}"/>
                          </div>
                          <div class="form-group">
                              <label for="keywords">Keywords :</label>
                              <input type="text" class="form-control" name="keywords" value="{{ (!empty($cardData->keywords))?$cardData->keywords:"" }}"/>
                          </div>
<div class="row">
                    <div class="col-lg-6">
<div class="form-group">
                              <label for="facebook">Facebook :</label>
                              <input type="text" class="form-control" name="facebook" value="{{ (!empty($cardData->facebook))?$cardData->facebook:"" }}"/>
                          </div>
                    </div>
                    <div class="col-lg-6">
<div class="form-group">
                              <label for="instagram">Instagram :</label>
                              <input type="text" class="form-control" name="instagram" value="{{ (!empty($cardData->instagram))?$cardData->instagram:"" }}"/>
                          </div>
                    </div>
                  </div>
                        
                        <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                              <label for="linkedin">Linked In :</label>
                              <input type="text" class="form-control" name="linkedin" value="{{ (!empty($cardData->linkedin))?$cardData->linkedin:"" }}"/>
                          </div>
                    </div>
                    <div class="col-lg-6">
                                                <div class="form-group">
                              <label for="twitter">Twitter :</label>
                              <input type="text" class="form-control" name="twitter" value="{{ (!empty($cardData->twitter))?$cardData->twitter:"" }}"/>
                          </div>
                    </div>
                    </div>  
              </div>
              
              @if(!empty($cardData))

                  
              
                  @if($cardData->status == 0)
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group ">
                          <label for="review-submit">Submit card for review</label>
                          <input type="checkbox" class="form-control" name="review-submit" value="yes" />
                      </div>


                    </div>

                    

                  </div>
                  @endif
    
                  
                @endif
          

          <button type="submit" class="btn btn-primary">Update Card Info</button>
      </form>
  </div>
</div>
</div>
</div>
</div>
@endsection