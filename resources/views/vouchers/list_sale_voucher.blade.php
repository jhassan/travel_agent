@extends('layouts.app')

@section('content')
<div class="col-md-9">
	<div class="content-box-large">
		<div class="panel-heading">
			<legend>Sale Invoice Voucher</legend>
		</div>
		@if (Session::has('message_update'))
		   <div class="alert alert-info">{{ Session::get('message_update') }}</div>
		@endif
		<div class="panel-body">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
			<thead>
				<tr>
					<th>Pax Name</th>
					<th>PNR</th>
					<th>Ticket #</th>
					<th>Vendor / Payable</th>
					<th>Client / Receivable</th>
					<!--<th>Action</th>-->
				</tr>
			</thead>
			<tbody>
				@foreach($arrayVouchers as $voucher)
					<tr class="odd gradeX" id="row_{{ $voucher->id }}">
						<td>{{ $voucher->pax_name }}</td>
						<td>{{ $voucher->pnr }}</td>
						<td>{{ $voucher->ticket_no }}</td>
						<td>{{ $voucher->vendor_payable_amount }}</td>
						<td>{{ $voucher->client_receivable_amount }}</td>
						<!--<td class="center"><a href="/vouchers/{{ $voucher->id }}/edit_sale_voucher"><img src="/images/edit.png" alt="Edit"></a>&nbsp; &nbsp;<a id="{{ $voucher->id }}" class="deleteRecord"><img src="/images/delete.png" alt="Delete" style="cursor:pointer;"></a></td>-->
					</tr>
				@endforeach
			</tbody>
			</table>
			<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
		</div>
	</div>
</div>
<div id="dialog-confirm-delete" title="Delete Reocrs" style="display:none;">Do you want to delete this record?</div>
@endsection

@section('custom_js')

	<script src="/js/jquery.ui.dialog.js"></script>
	<script src="/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables/dataTables.bootstrap.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').dataTable();
	    $(document).on('click','.deleteRecord',function(e){
				var DelID = jQuery(this).attr("id");
				var token = $('input[name="_token"]').val();
				$("#dialog-confirm-delete").dialog({
								resizable: false,
								height:170,
								width: 400,
								modal: true,
								title: 'Delete Party',
								buttons: {
									Delete: function() {
										$(this).dialog('close');
										$.ajax({
                          type: "GET",
                      				url: '/parties/delete_party',
                          data: { DelID: DelID }
                      }).done(function( msg ) {
                          //alert( msg+'ttttt' );
                          if(msg == "delete")
                            $("#row_"+DelID).remove();
                      });
									},
									Cancel: function() {
									   $(this).dialog('close');
									}
								}
							});
									   
						return false;
						});
	} );
	</script>
@endsection
