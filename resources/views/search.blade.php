@extends('layouts.site.app')

@section('content')
<section class="home-filter-section">
        <div class="container">
            <div class="row">
                <form name="salonch-ajax-salonlist-form" id="salonchSLsearch" method="post">
                    <input type="hidden" name="action" value="swp_salonsearch">
                    
                    

                    

                    <input type="hidden" id="swp_salonsearch_nonce_filed" name="swp_salonsearch_nonce_filed" value="0dc121d504"><input type="hidden" name="_wp_http_referer" value="/ad/salonch/">                  <div class="col-md-6 col-sm-12 left-form">
                        <div class="location-wrap">
                            <input type="text" name="salon_city" class="searchbox" placeholder="Search for city or zip" id="address" autocomplete="off" data-frm="salonchSLsearch" value="" data-value="" onkeydown="if (event.keyCode == 13) { return false; }">

                            <span class="clearInput clearLocation">×</span>

                            <input type="hidden" name="city" id="city" value="">
                            <input type="hidden" name="state" id="state" value="">
                            <input type="hidden" name="zipcode" id="zipcode" value="">
                            <input type="hidden" name="country" id="country" value="">
                        </div>
                        
                        <div class="name-wrap">
                            <input type="text" name="salon_name" class="searchbox" placeholder="Search by company" value="" data-value="" id="inputSalonName">
                            
                            <span class="clearInput clearName">×</span>

                            <input type="hidden" name="last_id" class="salonLastID" value="386">
                            <input type="hidden" name="load_more" class="salonLoadMore" value="0">
                        </div>
                        
                        
                    </div>
                    <div class="col-md-6 col-sm-12 right-form">
                        <div class="salonch-multiselect-cover">
                            <select id="multiple-checkboxes" name="salon_type[]" class="salonch_multiselect" multiple="multiple" style="display: none;">
                                                                        <option value="1">Barber Shop</option>
                                                                                <option value="2">Hair Salon</option>
                                                                                <option value="3">Full Service Salon</option>
                                                                                <option value="4">Rental Salon</option>
                                                                                <option value="6">Kids Salon</option>
                                                                                <option value="7">Blow Dry Bar</option>
                                                                                <option value="22">Color Bar</option>
                                                                                <option value="8">Spa</option>
                                                                                <option value="9">Medical Spa</option>
                                                                                <option value="19">Massage Therapy Spa</option>
                                                                                <option value="10">Foot Spa</option>
                                                                                <option value="11">Nail Salon</option>
                                                                    </select><div class="btn-group"><button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="Hair Salon, Full Service Salon" aria-expanded="false"><span class="multiselect-selected-text">2  - Filters Selected</span> <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="1"> Barber Shop</label></a></li><li class="active"><a tabindex="0"><label class="checkbox"><input type="checkbox" value="2"> Hair Salon</label></a></li><li class="active"><a tabindex="0"><label class="checkbox"><input type="checkbox" value="3"> Full Service Salon</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="4"> Rental Salon</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="6"> Kids Salon</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="7"> Blow Dry Bar</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="22"> Color Bar</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="8"> Spa</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="9"> Medical Spa</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="19"> Massage Therapy Spa</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="10"> Foot Spa</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="11"> Nail Salon</label></a></li></ul></div>
                            <span class="clearInput clearFilter">×</span>
                        </div>
                        <div class="switch-option checked">
                            <div>Show Job Openings</div>
                            <input type="checkbox" id="ChkJobOpening" name="set-name" class="switch-input" checked="">

                            <label for="ChkJobOpening" class="switch-label"></label>
                        </div>
                    </div>

                    <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1">
                </form>
            </div>
        </div>
    </section>
    
<div class="container">
    <h1>{{ __($searchTerm) }}</h1>

    <div class="row search-row">
        
           @if(!empty($cardData))

           @foreach ($cardData as $card)

           <div class="col-md-4">
           <div class="panel panel-default card">
            <div class="panel-body flow">
                        <div class="search-info">
                            <h2 class="business-name">
                                <a href="{{ url('card/' . $card['slug']) }}" title="{{ $card['business_name'] }}" rel="bookmark">
                                    {{ $card['business_name'] }}
                                </a>
                            </h2>

                            <div>
                                {{ $card['address'] }}
                                {{ $card['contact_primary'] }}
                            </div>
                        </div>
                    
            </div>
            <div class="panel-footer">Panel Footer</div>
        </div>
        </div>
        @endforeach 

        @else
        <div class="no-search-message">
            <h3> Currently there are no business found for your search criteria. </h3>
        </div>
        @endif 
</div>    
</div>




<!-- Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('messages.staff_info') }}</h4>
            </div>
            <form action="{{ route('users.update','test') }}" method="post" class="form-horizontal" id="customerEditForm">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    @include('provider.staff.view')
                </div>   
            </form>
        </div>
    </div>
</div> 


@endsection

@section('page-js-script')
<script type="text/javascript">
    //Open Edit Service Provider Model with Data
    $('#editProviderModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var _id = button.data('id')

        var modal = $(this)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{ url('/admin/getProvider') }}",
            method: 'post',
            data: {id: _id},
            success: function (result) {
                modal.find('.modal-body #id').val(result.data.id);
                modal.find('.modal-body #unique_id').val(result.data.unique_id);
                modal.find('.modal-body #name').val(result.data.name);
                modal.find('.modal-body #area_id').val(result.data.area_id);
                modal.find('.modal-body #address').val(result.data.address);
                modal.find('.modal-body #map').val(result.data.map);
                modal.find('.modal-body #lat').val(result.data.lat);
                modal.find('.modal-body #long').val(result.data.long);
                modal.find('.modal-body #incharge_name').val(result.data.incharge_name);
                modal.find('.modal-body #email').val(result.data.email);
                modal.find('.modal-body #phone').val(result.data.phone);
                modal.find('.modal-body #owner_name').val(result.data.owner_name);
                modal.find('.modal-body #owner_phone').val(result.data.owner_phone);
                modal.find('.modal-body #crn').val(result.data.crn);
                modal.find('.modal-body #lincense').val(result.data.lincense);
                modal.find('.modal-body #comment').val(result.data.comment);
                modal.find('.modal-body .select2').val(result.service).trigger('change');
                modal.find('.modal-body #accept_payment').val(result.data.accept_payment);
                modal.find('.modal-body #commission').val(result.data.commission);
                modal.find('.modal-body #man').prop('checked', false);
                modal.find('.modal-body #women').prop('checked', false);
                modal.find('.modal-body #kid').prop('checked', false);
                if (result.data.man == 1) {
                    modal.find('.modal-body #man').prop('checked', true);
                }
                if (result.data.women == 1) {
                    modal.find('.modal-body #women').prop('checked', true);
                }
                if (result.data.kid == 1) {
                    modal.find('.modal-body #kid').prop('checked', true);
                }


                modal.find('.modal-body input:radio[name=auto_approve]').filter('[value="' + result.data.auto_approve + '"]').iCheck('check');


                modal.find('.modal-body #previewImages').html('<button type="button" class="close" id="close_imageBox" onClick="closeImgBox()"><span>×</span></button>');
                modal.find('.modal-body #previewImages').hide();
                if (result.shop_images.length == 0) {
                    modal.find('.modal-body #previewImages').append("{{ __('messages.no_images_uploaded') }}");
                } else {
                    jQuery.each(result.shop_images, function (i, val) {
                        var source = "{!! asset('images/shop') !!}" + "/" + val.filename;
                        modal.find('.modal-body #previewImages').append('<img src="' + source + '" height="100px" width="100px">');
                    });
                }
            }
        });
    });

    //Open Edit Customer Model with Data
    $('#editCustomerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var _id = button.data('id')

        var modal = $(this)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{ url('/getStaff') }}",
            method: 'post',
            data: {id: _id},
            success: function (result) {
                modal.find('.modal-body #id').val(result.data.id)
                modal.find('.modal-body #unique_id').val(result.data.unique_id)
                modal.find('.modal-body #name').val(result.data.name)
                modal.find('.modal-body #email').val(result.data.email)
                modal.find('.modal-body #phone').val(result.data.phone)
                modal.find('.modal-body #profession').val(result.data.profession)

                modal.find('.modal-body input:radio[name=gender]').filter('[value="' + result.data.gender + '"]').iCheck('check');

                modal.find('.modal-body #gender').val(result.data.gender)
                modal.find('.modal-body #area_id').val(result.data.area_id)
                modal.find('.modal-body #address').val(result.data.address)
            }
        });
    });

    $('#viewBookingModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var _id = button.data('id');

        var modal = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{ route('admin.getBooking') }}",
            method: 'post',
            data: {id: _id},
            success: function (result) {
                //console.log(result.data);
                modal.find('.modal-body #id').val(result.data.id);
                modal.find('.modal-body #unique_id').val(result.data.unique_id);
                modal.find('.modal-body #username').val(result.data.customer.name);
                modal.find('.modal-body #booking_date').val(result.data.booking_date);
                modal.find('.modal-body #booking_time').val(result.data.booking_starttime);
                modal.find('.modal-body #service_provider').val(result.data.shop.name);
                modal.find('.modal-body #payment').val(result.data.final_amount);
                modal.find('.modal-body #services').val(result.services);
                modal.find('.modal-body #staff').val(result.barber);

                modal.find('.modal-body #payment_method').val(result.data.payment_method);
                modal.find('.modal-body .label-primary').removeClass().addClass("label label-primary " + result.data.booking_class);
                modal.find('.modal-body .label-primary').html(result.data.booking_status);


            }
        });
    });

</script>
@endsection