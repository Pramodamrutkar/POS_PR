@extends('frontend.appother')

@section('content')
<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{url('assets/css/style.css')}}" rel="stylesheet">
<link href="{{url('assets/css/custom.css')}}" rel="stylesheet">
<link href="{{url('assets/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{url('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
<link href="{{url('assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet">
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

 <!-- Header Area Start 
    ====================================================== -->
<section class="banner-sec internal-banner" style="background-image:url(assets/frontend/img/about-banner.jpg)">

<!-- Start: slider-overview -->
<div class="balck-solid">
	<!-- Start: slider -->
    <div class="container">
        <div class="banner-mid-text internal-header">
<div class="row">
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

@foreach($table_result as $tables)
<div class="col-xs-12 col-sm-4 col-md-6 col-lg-3 12 all">
    <div class="widget white-bg text-center product_list h-100 tableid_{{ $tables->id }}">
        <img width="100px" alt="image" class="img-circle" src="http://localhost/vijus/herbs/noimage.jpg">
        <h5 style="padding-left:5px; text-align:left;color: #000 !important;text-transform: unset;" class="m-xs heading-size_image">Table {{ $tables->id }}</h5> 
        <p id="remaining_time_{{ $tables->id }}"><span> </span></p>
        <p id="time_slot_{{ $tables->id }}"><span><b> Time :</b>{{ $tables->book_time }} To {{ $tables->end_book_time }} </span></p>
        <button data-start_time="{{ $tables->book_time }}" data_end_time="{{ $tables->end_book_time }}" data-name="{{ $tables->table_name }}" id="table_{{ $tables->id }}" type="button" onclick="selectTable(`<?php echo $tables->id; ?>`)" class="btn btn-sm btn-primary m-r-sm AddToCart tag-margin tag-btn">Book Table {{ $tables->id }}</button>         
                       
    </div>
</div>
@endforeach 
        </div>
        
    </div>

                </div>
            </div> 
            <!-- End: slider -->
            
        </div>  
        <!-- End: slider-overview -->
    </section>
    <!-- =================================================
    Header Area End -->

<div class="modal inmodal" id="ManageTableByUser" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content bounceInRight confirm-modal">

            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
                <h4 class="modal-title" id="">Book Table</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-sm-12">
                    <label>Enter Your name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                </div>
                 <div class="col-sm-12">
                    <label>Enter Your Email</label>
                    <div class="form-group">
                        <input type="email" class="form-control" name="emails" id="emails">
                    </div>
                </div>

                <div class="col-sm-12">
                    <label>Enter Your Phone</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                </div>
               
                <input type="hidden" name="hidden_table_id" id="hidden_table_id" value="">
                <button type="button" onclick="BookTable($('#hidden_table_id').val())" class="btn btn-sm">Book Table</button>

            </div>

        </div>

    </div>

</div>
<div id="timer">
  <span id="days"></span>days
  <span id="hours"></span>hours
  <span id="minutes"></span>minutes
  <span id="seconds"></span>seconds
</div>
<script src="{{url('assets/js/moment.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <!-- =================================================
    About Our Story  Area End -->
<style type="text/css">

    .nmpd-grid {

        border: none;

        padding: 20px;

    }

    .nmpd-grid>tbody>tr>td {

        border: none;

    }

    /* Some custom styling for Bootstrap */

    

    .qtyInput {

        display: block;

        width: 100%;

        padding: 6px 12px;

        color: #555;

        background-color: white;

        border: 1px solid #ccc;

        border-radius: 4px;

        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);

        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);

        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;

        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;

        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;

    }


    .cart-item {

        max-height: 160px;

        overflow-y: scroll;

    }

    

    .scale-anm {

        transform: scale(1);

    }

    

    .tile {

        -webkit-transform: scale(0);

        transform: scale(0);

        -webkit-transition: all 350ms ease;

        transition: all 350ms ease;

    }

    

    .tile:hover {}

    

    .product_list {

        min-height: 240px !important;

        margin-top: 0px;

    }

    .product_list h2 {

        padding: 2px 8px;

        margin-bottom: 8px !important;

        text-align: left;
    }
    .bookedContent{
        pointer-events: none;
        opacity: 0.5;
        cursor:no-drop;
    }

</style>    

<script type="text/javascript">

function closeModal() {
    $('#ManageTableByUser').hide();
}
function selectTable(tables_id) {
     var tableid = tables_id;
     $('#hidden_table_id').val(tableid);
     $('#ManageTableByUser').show();
}
function BookTable(tab_id) {
    var table_id = tab_id;
    var start_book_time = '';
    var end_book_time = '';

    var now = moment();
    start_book_time = now.format("YYYY-MM-DD hh:mm:ss")
    var future = now.add(40, 'minutes');
    end_book_time = future.format("YYYY-MM-DD hh:mm:ss");
    console.log("table_id===>"+table_id)
    console.log(start_book_time+"==="+end_book_time);

    var timer;
    var compareDate = new Date();
    compareDate.setMinutes(compareDate.getMinutes() + 40); 

    timer = setInterval(function() {
      timeBetweenDates(compareDate);
    }, 1000);


    var username = $('#username').val();
    var phone = $('#phone').val();
    var emails = $('#emails').val();
    
if(start_book_time != '' && end_book_time != '')
    $.ajax('table_ajax_book_front', {
        type: 'POST',  // http method   
        data: { 
                _token : '<?php echo csrf_token() ?>',
                "id" : table_id,
                "book_time" : start_book_time,
                "end_book_time" : end_book_time,
                "is_admin" : 0, 
                "email" : emails,
                "name" : username,
                "phone" : phone,
              

             },  // data to submit
        success: function (data, status) {
            var booking_slot = data;
            var result = booking_slot.book_data[0];
           
            $('#time_slot_'+result.id).html("<span><b> Time :</b>"+result.book_time+" To "+result.end_book_time+"</span>");
            $('#ManageTableByUser').hide();
            $('.tableid_'+table_id).addClass('bookedContent');
            setInterval(function(){
                var remaining_slot_interval = booking_slot.book_data.remaining_time;
                $('#remaining_time_'+table_id).html('<span>'+remaining_slot_interval+'</span>');
            },1000);
        },
        error: function (jqXhr, textStatus, errorMessage) {
              
        }
    });

}       




function timeBetweenDates(toDate) {
  var dateEntered = toDate;
  var now = new Date();
  var difference = dateEntered.getTime() - now.getTime();

  if (difference <= 0) {
    // Timer done
    clearInterval(timer);
  
  } else {
    
    var seconds = Math.floor(difference / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);

    hours %= 24;
    minutes %= 60;
    seconds %= 60;

    $("#days").text(days);
    $("#hours").text(hours);
    $("#minutes").text(minutes);
    $("#seconds").text(seconds);
  }
}
</script>
  


@endsection