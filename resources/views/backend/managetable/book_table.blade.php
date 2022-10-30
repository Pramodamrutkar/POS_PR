@extends( 'layouts.app' )
@section( 'content' )

<link href="{{url('assets/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{url('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
<link href="{{url('assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet">
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<div class="wrapper wrapper-content animated fadeInRight">

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Table Booking</h2>
                </div>
                <div class="col-lg-2">
                </div>
</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

@foreach($table_result as $tables)
<div class="col-xs-12 col-sm-4 col-md-6 col-lg-3 12 all">
	<div class="widget white-bg text-center product_list h-100">
		<img width="100px" alt="image" class="img-circle" src="http://localhost/vijus/herbs/noimage.jpg">
		<h2 style="padding-left:5px; text-align:left" class="m-xs heading-size_image">Table {{ $tables->id }}</h2> 
		<p id="time_slot_{{ $tables->id }}"><span><b> Time :</b>{{ $tables->book_time }} To {{ $tables->end_book_time }} </span></p>
		<button data-start_time="{{ $tables->book_time }}" data_end_time="{{ $tables->end_book_time }}" data-name="{{ $tables->table_name }}" id="table_{{ $tables->id }}" type="button" onclick="BookTable(`<?php echo $tables->id; ?>`)" class="btn btn-sm btn-primary m-r-sm AddToCart tag-margin tag-btn">Book Table {{ $tables->id }}</button> 		
		<button type="button" onclick="BookTable(`<?php echo $tables->id; ?>`,`1`)" class="btn btn-sm">Edit Table {{ $tables->id }}</button>				
	</div>
</div>
@endforeach	
		</div>
		
	</div>
</div>

<div class="modal inmodal" id="ManageTableByAdmin" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">

		<div class="modal-content animated bounceInRight confirm-modal">

			<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
				<h4 class="modal-title" id="">Book Table</h4>
			</div>
			<div class="modal-body clearfix">
				<div class="col-sm-12">
					<label>Start Book Time</label>
					<div class="form-group">
						<input type="text" class="form-control" name="start_time_edit_mode" id="start_time_edit_mode">
					</div>
				</div>
				<div class="col-sm-12">
					<label>End Book Time</label>
					<div class="form-group">
						<input type="text" class="form-control" name="end_time_edit_mode" id="end_time_edit_mode">
					</div>
				</div>
				<input type="hidden" name="hidden_table_id" id="hidden_table_id" value="">
				<button type="button" onclick="BookTable($('#hidden_table_id').val(),`1`,`1`)" class="btn btn-sm">Book Table</button>

			</div>

		</div>

	</div>

</div>


<link rel="stylesheet" href="{{url('assets/numpad/jquery.numpad.css')}}">

<script src="{{url('assets/js/lodash.min.js')}}"></script>

<script src="{{url('assets/js/moment.js')}}"></script>
<script src="{{url('assets/js/jquery.datetimepicker.full.min.js')}}"></script>

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
</style>

<script type="text/javascript">
$(document).ready(function(){
  	$('#start_time_edit_mode').datetimepicker();
	$('#end_time_edit_mode').datetimepicker();
});

function closeModal() {
	$('#ManageTableByAdmin').hide();
}
function BookTable(tab_id, editmode = '', hide_modal = '') {
	var table_id = tab_id;
	var start_book_time = '';
	var end_book_time = '';

	if(editmode != 1){
		var now = moment();
		start_book_time = now.format("YYYY-MM-DD hh:mm:ss")
		var future = now.add(40, 'minutes');
		end_book_time = future.format("YYYY-MM-DD hh:mm:ss");
		console.log(start_book_time+"==="+end_book_time);
	}else{
		$('#ManageTableByAdmin').show();
		$('#hidden_table_id').val(table_id);
		console.log(table_id);
		if(hide_modal == 1){
			$('#ManageTableByAdmin').hide();
		}
		start_book_time = $('#start_time_edit_mode').val();
		end_book_time = $('#end_time_edit_mode').val();
	}
	
if(start_book_time != '' && end_book_time != '')
	$.ajax('table_ajax_book', {
	    type: 'POST',  // http method	
	    data: { 
	    		_token : '<?php echo csrf_token() ?>',
	    		"id" : table_id,
	    		"book_time" : start_book_time,
	    		"end_book_time" : end_book_time,
	    		"is_admin" : 1,

	    	 },  // data to submit
	    success: function (data, status) {
	    	var booking_slot = data;
	    	var result = booking_slot.book_data[0];
	    	//console.log(result);
	    	$('#time_slot_'+result.id).html("<span><b> Time :</b>"+result.book_time+" To "+result.end_book_time+"</span>");
	    },
	    error: function (jqXhr, textStatus, errorMessage) {
	          
	    }
	});

}		


</script>


@endsection