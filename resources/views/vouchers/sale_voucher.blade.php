@extends('layouts.app')

@section('content')
<div class="col-md-9">
	<div class="content-box-large">
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		@if (Session::has('purchase_message'))
		   <div class="alert alert-info">{{ Session::get('purchase_message') }}</div>
		@endif
		<div class="panel-body">
			<form role="form" id="purchase_form" method="POST" action="">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<fieldset>
				<div class="panel-heading">
					<h1 class="text-right">Sale Invoice</h1>
					<legend>Pessenger Details</legend>
				</div>
				<div class="form-group col-sm-3">
					<label>Pax Name</label>
					<input class="form-control" placeholder="Pax Name" maxlength="50" name="pax_name" type="text" value="">
				</div>
				<div class="form-group col-sm-3">
					<label>PNR</label>
					<input class="form-control" placeholder="PNR" maxlength="10" name="pnr" type="text" value="">
				</div>
				<div class="form-group col-sm-3">
					<label>Ticket No</label>
					<input class="form-control" placeholder="Ticket No" maxlength="14" name="ticket_no" type="text" value="">
				</div>
				<div class="clear"></div>
				<div class="form-group col-sm-3">
					<label>Sector</label>
					<input class="form-control" placeholder="Sector" maxlength="14" name="sector" type="text" value="">
				</div>
				<div class="form-group col-sm-3" style="margin-top:15px;">
					<label class="radio radio-inline">
						<input name="flight_way" id="radio_one_way" type="radio" vlaue="1" checked="checked">One Way</label>
					<label class="radio radio-inline" style="margin-top: 10px;">
						<input name="flight_way" id="radio_two_way" type="radio" value="2">Return</label>
				</div>
				<div class="form-group col-sm-3" id="div_departre_date">
					<label>Departre Date</label>
					<div class="bfh-datepicker" data-name="depart_date" data-format="d-m-y" data-date="today">
						<div class="input-group bfh-datepicker-toggle" data-toggle="bfh-datepicker">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="text" name="depart_date" class="form-control" placeholder="" readonly="">
						</div>
					</div>
				</div>
				<div class="form-group col-sm-3 hide" id="div_return_date">
					<label>Return Date</label>
					<div class="bfh-datepicker" data-name="return_date" data-format="d-m-y" data-date="today">
						<div class="input-group bfh-datepicker-toggle" data-toggle="bfh-datepicker">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="text" name="return_date" class="form-control" placeholder="" readonly="">
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="panel-heading">
					<legend>Pricing</legend>
				</div>
				<div class="form-group col-sm-3 pricing text-center">
					<label>Actual Value</label>
					<div class="clear"></div>
					<div class="form-group col-sm-2" style="padding:0px; margin-bottom:0px; margin-top: 8px;">Fare</div>
					<div class="form-group col-sm-10"><input class="form-control number_only focus_blur" placeholder="Basic Fare" maxlength="10" name="basic_fare" id="basic_fare" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-2" style="padding:0px; margin-bottom:0px; margin-top: 8px;">Tax</div>
					<div class="form-group col-sm-10"><input class="form-control number_only focus_blur" placeholder="Tax" maxlength="7" name="tax" id="tax" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-2" style="padding:0px; margin-bottom:0px; margin-top: 8px;">Total</div>
					<div class="form-group col-sm-10"><input style="background-color: #e5e5e5; font-weight: bold;" class="form-control number_only" disabled="disabled" placeholder="Total" maxlength="7" name="actual_fare_total" id="actual_fare_total" type="text" value="0"><input type="hidden" id="hdn_actual_fare_total" name="actual_fare_total" value="0"></div>
				</div>
				<div class="form-group col-sm-4 text-center vendors">
					<label style="text-align: center !important;"><a style="cursor:pointer;" data-rel="collapse" id="refresh_vendor"><i class="glyphicon glyphicon-refresh"></i></a>&nbsp;&nbsp;&nbsp;Vendor / Payable</label>
					<div class="clear"></div>
					<div class="form-group col-sm-4" style="padding:0px; margin-bottom:0px; margin-top: 8px;">Receive Comm.</div>
					<div class="form-group col-sm-3"><input placeholder="%" class="form-control number_only focus_blur col-sm-1 small_box" maxlength="2" name="ven_percent_rec_comm" id="ven_percent_rec_comm" type="text" value=""></div>
					<div class="form-group col-sm-5" style="padding-left:0px;"><input placeholder="Receive Comm." class="form-control focus_blur number_only col-sm-1" maxlength="2" name="vendor_rec_comm_total" id="vendor_rec_comm_total" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-4" style="padding:0px; margin-bottom:0px; margin-top: 8px;">Give PSF</div>
					<div class="form-group col-sm-3"><input placeholder="%" class="form-control focus_blur number_only col-sm-1 small_box" maxlength="2" name="ven_give_psf_comm" id="ven_give_psf_comm" type="text" value=""></div>
					<div class="form-group col-sm-5" style="padding-left:0px;"><input placeholder="Give PSF" class="form-control focus_blur number_only col-sm-1" maxlength="2" name="ven_give_psf_total" id="ven_give_psf_total" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-4" style="padding:0px; margin-bottom:0px; margin-top: 8px;">WHT</div>
					<div class="form-group col-sm-3"><input placeholder="%" class="form-control focus_blur number_only col-sm-1 small_box" maxlength="2" name="ven_wht_percent_comm" id="ven_wht_percent_comm" type="text" value=""></div>
					<div class="form-group col-sm-5" style="padding-left:0px;"><input placeholder="WHT" class="form-control focus_blur number_only col-sm-1" maxlength="2" name="ven_wht_total" id="ven_wht_total" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-2" style="padding:0px; margin-bottom:0px; margin-top: 8px;"></div>
					<div class="form-group col-sm-8 text-right" style="float:right;"><input placeholder="" style="background-color: #e5e5e5; font-weight: bold;" class="form-control number_only" disabled="disabled" placeholder="Total" maxlength="7" name="ven_main_total" id="ven_main_total" type="text" value="0"><input type="hidden" name="ven_main_total" id="hdn_ven_main_total" value=""></div>
				</div>
				<div class="form-group col-sm-4 text-center">
					<label style="text-align: center !important;"><a style="cursor:pointer;" data-rel="collapse" id="refresh_client"><i class="glyphicon glyphicon-refresh"></i></a>&nbsp;&nbsp;&nbsp;Client / Receivable</label>
					<div class="clear"></div>
					<div class="form-group col-sm-4" style="padding:0px; margin-bottom:0px; margin-top: 8px;">Give Comm.</div>
					<div class="form-group col-sm-3"><input placeholder="%" class="form-control focus_blur number_only col-sm-1 small_box" maxlength="2" name="client_percent_rec_comm" id="client_percent_rec_comm" type="text" value=""></div>
					<div class="form-group col-sm-5" style="padding-left:0px;"><input placeholder="Give Comm." class="form-control focus_blur number_only col-sm-1" maxlength="2" name="client_rec_comm_total" id="client_rec_comm_total" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-4" style="padding:0px; margin-bottom:0px; margin-top: 8px;">Receive PSF</div>
					<div class="form-group col-sm-3"><input placeholder="%" class="form-control focus_blur number_only col-sm-1 small_box" maxlength="2" name="client_receive_psf_comm" id="client_receive_psf_comm" type="text" value=""></div>
					<div class="form-group col-sm-5" style="padding-left:0px;"><input placeholder="Receive PSF" class="form-control focus_blur number_only col-sm-1" maxlength="2" name="client_receive_psf_total" id="client_receive_psf_total" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-4" style="padding:0px; margin-bottom:0px; margin-top: 8px;">WHT</div>
					<div class="form-group col-sm-3"><input placeholder="%" class="form-control focus_blur number_only col-sm-1 small_box" maxlength="2" name="client_wht_percent_comm" id="client_wht_percent_comm" type="text" value=""></div>
					<div class="form-group col-sm-5" style="padding-left:0px;"><input placeholder="WHT" class="form-control focus_blur number_only col-sm-1" maxlength="2" name="client_wht_total" id="client_wht_total" type="text" value="0"></div>
					<div class="clear"></div>
					<div class="form-group col-sm-2" style="padding:0px; margin-bottom:0px; margin-top: 8px;"></div>
					<div class="form-group col-sm-8 text-right" style="float:right;"><input placeholder="" style="background-color: #e5e5e5; font-weight: bold;" class="form-control number_only" disabled="disabled" placeholder="Total" maxlength="7" id="client_main_total" type="text" value="0"><input type="hidden" name="client_main_total" id="hdn_client_main_total" value="0"></div>
				</div>
				<div class="clear"></div>
				<div class="panel-heading">
					<legend></legend>
				</div>
				<div class="form-group col-sm-3 text-center">
					<label>Profit & Loss</label>
					<input style="background-color: #e5e5e5; font-weight: bold;" class="form-control number_only" disabled="disabled" placeholder="Total" maxlength="7" id="profit_loss_total" type="text" value="0">
					<input type="hidden" name="profit_loss_total" id="hdn_profit_loss_total" value="0"> 
				</div>
				<div class="form-group col-sm-4 text-center">
					<div>
  						<label>Vendor / Payable</label>
						<div class="bfh-selectbox text-left" data-name="vendor_id" data-value="" data-filter="true">
						  <div data-value="">Select Party Type</div>
						  <div data-value="1">Purchase Party</div>
						  <div data-value="2">Sale Party</div>
						</div>
  					</div>
  					<div class="form-group col-sm-12 text-right"><input style="background-color: #e5e5e5; font-weight: bold; margin-top: 10px;" class="form-control number_only" disabled="disabled" placeholder="Total" maxlength="7" name="basic_fare" type="text" value="0"></div>
				</div>
				<div class="form-group col-sm-4 text-center">
					<div>
  						<label>Client / Receivable</label>
						<div class="bfh-selectbox text-left" data-name="client_id" data-value="" data-filter="true">
						  <div data-value="">Select Party Type</div>
						  <div data-value="1">Purchase Party</div>
						  <div data-value="2">Sale Party</div>
						</div>
						<div class="form-group col-sm-12 text-right"><input style="background-color: #e5e5e5; font-weight: bold; margin-top: 10px;" class="form-control number_only" disabled="disabled" placeholder="Total" maxlength="7" name="basic_fare" type="text" value="0"></div>
  					</div>
				</div>
			</fieldset>
			<div class="form-group col-sm-3">
		      <button type="button" id="submit_button" class="btn btn-primary">Save</button>
		    </div>
		    
		</form>
		</div>
	</div>
</div>
<input type="hidden" id="item_counter" name="item_counter" value="0" />
<style type="text/css">
.amount_text {
	text-align: center;
    font-size: 14px;
    font-weight: bold;
    padding-top: 7px;
    margin-bottom: 0px;
}
/*.pricing input{margin-bottom: 15px;}*/
.pricing { border-right: solid 1px #e5e5e5;}
.vendors { border-right: solid 1px #e5e5e5;}
.cursor{
	cursor: pointer;
}
.table-responsive table th, td{text-align: right;}
#product_id .bfh-selectbox-options{width: 349px;}
.text-center {text-align: center !important;}
.small_box{width: 45px;}
</style>
@endsection

@section('custom_js')
	<script type="text/javascript">
	$(document).ready(function (){
		$("#party_id").removeClass('hide');
	
		// Show hide datapicker
		$("#radio_two_way").click(function () {
			$("#div_return_date").removeClass('hide');
			$("#div_departre_date").removeClass('hide');
		});
		$("#radio_one_way").click(function () {
			$("#div_return_date").addClass('hide');
			$("#div_departre_date").removeClass('hide');
		});
		// ven_give_psf_comm
		$("#ven_give_psf_comm").click(function (){
			$("#ven_percent_rec_comm").attr("disabled","disabled");
			$("#vendor_rec_comm_total").attr("disabled","disabled");
			$("#ven_wht_percent_comm").attr("disabled","disabled");
			$("#ven_wht_total").attr("disabled","disabled");
		});
		// refresh vendor
		$("#refresh_vendor").click(function (){
			$("#ven_percent_rec_comm").removeAttr("disabled","disabled");
			$("#vendor_rec_comm_total").removeAttr("disabled","disabled");
			$("#ven_wht_percent_comm").removeAttr("disabled","disabled");
			$("#ven_wht_total").removeAttr("disabled","disabled");
			$("#ven_give_psf_comm").removeAttr("disabled","disabled");
			$("#ven_give_psf_total").removeAttr("disabled","disabled");

			$("#ven_percent_rec_comm").val('');
			$("#vendor_rec_comm_total").val(0);
			$("#ven_wht_percent_comm").val('');
			$("#ven_wht_total").val(0);
			$("#ven_give_psf_comm").val('');
			$("#ven_give_psf_total").val(0);
			$("#ven_main_total").val(0);
		});
		// ven_percent_rec_comm
		$("#ven_percent_rec_comm").click(function (){
			$("#ven_give_psf_comm").attr("disabled","disabled");
			$("#ven_give_psf_total").attr("disabled","disabled");
		});
		// client_receive_psf_comm
		$("#client_receive_psf_comm").click(function (){
			$("#client_percent_rec_comm").attr("disabled","disabled");
			$("#client_rec_comm_total").attr("disabled","disabled");
			$("#client_wht_percent_comm").attr("disabled","disabled");
			$("#client_wht_total").attr("disabled","disabled");
		});
		// refresh client
		$("#refresh_client").click(function (){
			$("#client_percent_rec_comm").removeAttr("disabled","disabled");
			$("#client_rec_comm_total").removeAttr("disabled","disabled");
			$("#client_wht_percent_comm").removeAttr("disabled","disabled");
			$("#client_wht_total").removeAttr("disabled","disabled");
			$("#client_receive_psf_comm").removeAttr("disabled","disabled");
			$("#client_receive_psf_total").removeAttr("disabled","disabled");

			$("#client_percent_rec_comm").val('');
			$("#client_rec_comm_total").val(0);
			$("#client_wht_percent_comm").val('');
			$("#client_wht_total").val(0);
			$("#client_receive_psf_comm").val('');
			$("#client_receive_psf_total").val(0);
		});
		// client_percent_rec_comm
		$("#client_percent_rec_comm").click(function (){
			$("#client_receive_psf_comm").attr("disabled","disabled");
			$("#client_receive_psf_total").attr("disabled","disabled");
		});
		// calculate actual value basic fare
		$("#basic_fare").keyup(function (){
			var basic_fare = $(this).val();
			if(basic_fare != "" && basic_fare != null && basic_fare != "NaN")
			{
				basic_fare = remove_comma(basic_fare);
				var tax = $("#tax").val();
				tax = remove_comma(tax);
				var total_fare = parseInt(tax) + parseInt(basic_fare);
				if(isNaN(total_fare))
					$("#actual_fare_total").val(0);	
				else
					$("#actual_fare_total").val(addCommas(total_fare));
			}
			else
			{
				$("#actual_fare_total").val(0);
			}
			
		});
		// calculate actual value tax
		$("#tax").keyup(function (){
			var tax = $(this).val();
			if(tax != "" && tax != null && tax != "NaN")
			{
				tax = remove_comma(tax);
				var basic_fare = $("#basic_fare").val();
				basic_fare = remove_comma(basic_fare);
				var total_fare = parseInt(tax) + parseInt(basic_fare);
				if(isNaN(total_fare))
					$("#actual_fare_total").val(0);	
				else
					$("#actual_fare_total").val(addCommas(total_fare));	
			}
			else
			{
				$("#actual_fare_total").val(0);
			}
			
		});
		// calculate vendor
		$("#ven_percent_rec_comm").keyup(function (){
			var ven_percent_rec_comm = $(this).val();
			if(ven_percent_rec_comm != "" && ven_percent_rec_comm != null && ven_percent_rec_comm != "NaN")
			{
				var ven_percent_rec_comm = remove_comma(ven_percent_rec_comm);
				var basic_fare = $("#basic_fare").val();
				basic_fare = remove_comma(basic_fare);
				//console.log(basic_fare+"***"+ven_percent_rec_comm);
				var vendor_rec_comm_total = parseInt(ven_percent_rec_comm) / 100 * basic_fare;
				if(vendor_rec_comm_total != "" && vendor_rec_comm_total != null && vendor_rec_comm_total != "NaN")
				{
					var vendor_rec_comm_total = numberFormat(vendor_rec_comm_total,"");
					vendor_rec_comm_total = addCommas(vendor_rec_comm_total);
					$("#vendor_rec_comm_total").val(vendor_rec_comm_total);
					$("#ven_main_total").val(vendor_rec_comm_total);	
				}
			}
			else
			{
				$("#vendor_rec_comm_total").val(0);
				$("#ven_main_total").val(0);
			}
			
		});
		// vendor WHT
		$("#ven_wht_percent_comm").keyup(function (event) {
			vendor_rec_comm_total = 0;
			var ven_wht_percent_comm = $(this).val();
			if(ven_wht_percent_comm != "" && ven_wht_percent_comm != null && ven_wht_percent_comm != "NaN" && event.keyCode != 8)
			{
				var vendor_rec_comm_total = $("#vendor_rec_comm_total").val();
				vendor_rec_comm_total = remove_comma(vendor_rec_comm_total);
				var vendor_rec_comm_total = parseInt(ven_wht_percent_comm) / 100 * vendor_rec_comm_total;
				if(vendor_rec_comm_total != "" && vendor_rec_comm_total != null && vendor_rec_comm_total != "NaN")
				{
					vendor_rec_comm_total = numberFormat(vendor_rec_comm_total,"");
					vendor_rec_comm_total = addCommas(vendor_rec_comm_total);
					$("#ven_wht_total").val(vendor_rec_comm_total);
				}
				ven_main_total = 0;
				var ven_main_total = $("#ven_main_total").val();
				ven_main_total = remove_comma(ven_main_total);
				vendor_rec_comm_total = remove_comma(vendor_rec_comm_total);
				setTimeout(function (){
					main_vendor_total = 0;
					var main_vendor_total = parseInt(ven_main_total) + parseInt(vendor_rec_comm_total);
					main_vendor_total = numberFormat(main_vendor_total,"");
					main_vendor_total = addCommas(main_vendor_total);
					$("#ven_main_total").val(main_vendor_total);
				},1000);
			}
			else
			{
				$("#ven_wht_total").val(0);
				var vendor_rec_comm_total = $("#vendor_rec_comm_total").val();
				$("#ven_main_total").val(vendor_rec_comm_total);
			}
		});
		
		// Vendor PSF
		$("#ven_give_psf_comm").click(function (){
			$("#ven_main_total").val(0)
		});
		$("#ven_give_psf_comm").keyup(function (){
			var ven_give_psf_comm = $(this).val();
			if(ven_give_psf_comm != "" && ven_give_psf_comm != null && ven_give_psf_comm != "NaN")
			{
				var basic_fare = $("#basic_fare").val();
				basic_fare = remove_comma(basic_fare);
				var ven_give_psf_comm = parseInt(ven_give_psf_comm) / 100 * basic_fare;
				if(ven_give_psf_comm != "" && ven_give_psf_comm != null && ven_give_psf_comm != "NaN")
				{
					ven_give_psf_comm = numberFormat(ven_give_psf_comm,"");
					ven_give_psf_comm = addCommas(ven_give_psf_comm);
					$("#ven_give_psf_total").val(ven_give_psf_comm);
					$("#ven_main_total").val(ven_give_psf_comm);
				}
			}

		});

		// calculate Client Give commisaion
		$("#client_percent_rec_comm").keyup(function (){
			var client_percent_rec_comm = $(this).val();
			if(client_percent_rec_comm != "" && client_percent_rec_comm != null && client_percent_rec_comm != "NaN")
			{
				var client_percent_rec_comm = remove_comma(client_percent_rec_comm);
				var basic_fare = $("#basic_fare").val();
				basic_fare = remove_comma(basic_fare);
				console.log(basic_fare+"***"+ven_percent_rec_comm);
				var client_rec_comm_total = parseInt(client_percent_rec_comm) / 100 * basic_fare;
				if(client_rec_comm_total != "" && client_rec_comm_total != null && client_rec_comm_total != "NaN")
				{
					var client_rec_comm_total = numberFormat(client_rec_comm_total,"");
					client_rec_comm_total = addCommas(client_rec_comm_total);
					$("#client_rec_comm_total").val(client_rec_comm_total);
					$("#client_main_total").val(client_rec_comm_total);	
				}
			}
			else
			{
				$("#client_rec_comm_total").val(0);
				$("#client_main_total").val(0);
			}
			
		});

		// Client WHT
		$("#client_wht_percent_comm").keyup(function (event) {
			client_rec_comm_total = 0;
			var client_wht_percent_comm = $(this).val();
			if(client_wht_percent_comm != "" && client_wht_percent_comm != null && client_wht_percent_comm != "NaN" && event.keyCode != 8)
			{
				var client_rec_comm_total = $("#client_rec_comm_total").val();
				client_rec_comm_total = remove_comma(client_rec_comm_total);
				var client_rec_comm_total = parseInt(client_wht_percent_comm) / 100 * client_rec_comm_total;
				if(client_rec_comm_total != "" && client_rec_comm_total != null && client_rec_comm_total != "NaN")
				{
					client_rec_comm_total = numberFormat(client_rec_comm_total,"");
					client_rec_comm_total = addCommas(client_rec_comm_total);
					$("#client_wht_total").val(client_rec_comm_total);
				}
				client_main_total = 0;
				var client_main_total = $("#client_main_total").val();
				client_main_total = remove_comma(client_main_total);
				client_rec_comm_total = remove_comma(client_rec_comm_total);
				setTimeout(function (){
					main_client_total = 0;
					var main_client_total = parseInt(client_main_total) + parseInt(client_rec_comm_total);
					main_client_total = numberFormat(main_client_total,"");
					main_client_total = addCommas(main_client_total);
					$("#client_main_total").val(main_client_total);
				},1000);
			}
			else
			{
				$("#client_wht_total").val(0);
				var client_rec_comm_total = $("#client_rec_comm_total").val();
				$("#client_main_total").val(client_rec_comm_total);
			}
		});
		
		// Client PSF
		$("#client_receive_psf_comm").click(function (){
			$("#client_main_total").val(0)
		});
		$("#client_receive_psf_comm").keyup(function (){
			var client_receive_psf_comm = $(this).val();
			if(client_receive_psf_comm != "" && client_receive_psf_comm != null && client_receive_psf_comm != "NaN")
			{
				var basic_fare = $("#basic_fare").val();
				basic_fare = remove_comma(basic_fare);
				var client_receive_psf_comm = parseInt(client_receive_psf_comm) / 100 * basic_fare;
				if(client_receive_psf_comm != "" && client_receive_psf_comm != null && client_receive_psf_comm != "NaN")
				{
					client_receive_psf_comm = numberFormat(client_receive_psf_comm,"");
					client_receive_psf_comm = addCommas(client_receive_psf_comm);
					$("#client_receive_psf_total").val(client_receive_psf_comm);
					$("#client_main_total").val(client_receive_psf_comm);
				}
			}

		});
		// onfocus and on blur
		$(".focus_blur").focus(function(){
		if (this.value == "0")
		{
		    this.value = "";
		 }
		});

		$(".focus_blur").blur(function(){
	        if (this.value == "")
	        {
	            this.value = "0";
	        }
	    });

	}); // end ready
	function addCommas(nStr)
	{
	    nStr += '';
	    x = nStr.split('.');
	    x1 = x[0];
	    x2 = x.length > 1 ? '.' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
	    return x1 + x2;
	}
	function numberFormat(val, decimalPlaces) {
	    var multiplier = Math.pow(10, decimalPlaces);
	    return (Math.round(val * multiplier) / multiplier).toFixed(decimalPlaces);
	}
	function remove_comma(number) {
		if (number.indexOf(",") >= 0)
			number = number.replace(',', '');
		if (number.indexOf(",") >= 0)
			number = number.replace(',', '');
		return number;	
	}
	</script>
@endsection
