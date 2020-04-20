@extends('admin.layouts.app')


@section('content')
@include('elements.messages')
<style type="text/css">
        .p_card{
            background: url("../../../images/bg.png") 0 50% #0E406A;
            color: #00cc65; 
            width: 300px; /* 1050px; */
            height: 172px; /* 600px; */
            position: relative;
        }

        .p_card .inner {
            border-left: 5px solid #e98c14;
            padding: 10px;
            height: 100%;
            width: 100%;
            display: inline-table;

        }

        .p_card .name {
            color: #FFF;
            border-bottom: 2px solid #e98c14;
            margin: 0;
            font-size: 20px;
            padding: 0 0 5px 0;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .p_card .address {
            font-size: 14px;
            padding: 0px 0px;
            line-height: 16px;
        }

        .p_card .keywords {
            color: #888;
            font-size: 14px;
            padding: 0;
            font-weight: 600;
            min-height: 40px;
        }

        .p_card .card-contact-info {
            text-align: center;
            color: #e98c14;
            font-size: 18px;
            padding-top: 5px;
        }

        img.logoicon {
            width: 50px;
            height: 50px;
            position: absolute;
            bottom: 25px;
        }

        .p_card .info {
            color: #EDEDED;
            font-size: 12px;
            position: absolute;
            bottom: 8px;
            text-align: center;
        }
    </style>

    <input id="btn-Preview-Image" type="button" value="Preview"/>
    <a id="btn-Convert-Html2Image" href="#">Download</a>

    <a id="saveImg" href="#">save</a>

    <a href="{{ URL::to( 'admin/cards/view/' . $previous ) }}">Previous</a>
<a href="{{ URL::to( 'admin/cards/view/' . $next ) }}">Next</a>

<div id="html-content-holder" class="p_card">
        <div class="inner">
            <h3 class="name">
                {{ $cardData->business_name }}
            </h3>
            <?php
            /*
            <div class="address" style="color: #3e4b51;">
                {{ $cardData->address }}
            </div>
            <div class="keywords">{{ $cardData->keywords }}</div>        

            <div class="card-contact-info">
                 {{ $cardData->email_address }} <i class="fa fa-mail"></i>
            </div>
            <img src="{{ asset('/images/logoicon.svg') }}" class="logoicon">
            */
            ?>
            
            @if(!empty($cardData->business_person))
            <div class="card-contact-info">
                <i class="fa fa-user"></i> {{ $cardData->business_person }} 
            </div>
            @endif
            <div class="card-contact-info">
                <i class="fa fa-phone"></i> {{ $cardData->contact_primary }} 
            </div>
            
            <div class="info">
                https://cardbiz.in/card/{{ $cardData->slug }}
            </div>
        </div>
    </div>

    <br/>
    <h3>Preview :</h3>
    <div id="previewImage" data-imgname="{{ $cardData->id }}-{{ $cardData->slug }}"></div>


@endsection

@section('page-js-script')
<script>
        $(document).ready(function(){

            var element = $("#html-content-holder"); // global variable
            var getCanvas; // global variable

            $("#btn-Preview-Image").on('click', function () {
               html2canvas(element, {
                   onrendered: function (canvas) {
                    $("#previewImage").html(canvas);
                    getCanvas = canvas;
                }
            });
           });

            $("#btn-Convert-Html2Image").on('click', function () {
                var imgageData = getCanvas.toDataURL("image/png");
                // Now browser starts downloading it instead of just showing it
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
            });

            $("#saveImg").on('click', function () {
                var imgageData = getCanvas.toDataURL("image/png");
                var imgaeName = $("#previewImage").data('imgname');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.cards.savecard') }}",
                    data: { 
                        imgBase64: imgageData,
                        image_name: imgaeName,
                        _token: '{{csrf_token()}}'
                    }
                }).done(function(o) {
                    console.log('saved'); 
                });  
            });



            

        });

    </script>
@endsection
