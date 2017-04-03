@extends('layouts.app')

@section('content')

@php
if(Auth::check())
{
  $user_permission = Auth::user()->user_permission;
  $array_permission = explode(',',$user_permission);
} 
@endphp
<div class="col-md-9">
	<div class="content-box-large">
		<div class="panel-heading">
			<legend>View Vendor/Client</legend>
		</div>
		@if (Session::has('message_update'))
		   <div class="alert alert-info">{{ Session::get('message_update') }}</div>
		@endif
		<div class="panel-body">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
			<thead>
				<tr>
					<th>Name</th>
					<th>Address</th>
					<th>Phone #</th>
					<th>Party Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($arrayParties as $party)
					<tr class="odd gradeX" id="row_{{ $party->id }}">
						<td>{{ $party->name }}</td>
						<td>{{ $party->address }}</td>
						<td>{{ $party->phone_no }}</td>
						<td>@if($party->type_id == 1) Client @else Vendor @endif</td>
						<td class="center">
							@php
                              if (in_array("23", $array_permission)){
                            @endphp
                              <a href="/parties/{{ $party->id }}/edit"><img src="/images/edit.png" alt="Edit"></a>&nbsp; &nbsp;
                            @php
                            }
                              if (in_array("25", $array_permission)){
                            @endphp
                              <a id="{{ $party->id }}" class="deleteRecord"><img src="/images/delete.png" alt="Delete" style="cursor:pointer;" data-target="#myModal" data-toggle="modal"></a></td>
                            @php } @endphp
						</tr>
				@endforeach
			</tbody>
			</table>
			<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
		</div>
	</div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">Do you want to delete this record?</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="deleteRecord">Delete</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <input type="hidden" id="currentID" value="" />
    @endsection

@section('custom_js')

	<script src="/js/jquery.ui.dialog.js"></script>
	<script src="/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables/dataTables.bootstrap.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function() {
		// Get Delete Record ID
		$(document).on('click','.deleteRecord',function(e){
			var DelID = jQuery(this).attr("id");
			$("#currentID").val(DelID);
		});
	    $('#example').dataTable();
	    // Delete Record show Dialog Box
		$(document).on('click','#deleteRecord',function(e){
			var DelID = $("#currentID").val();
			var token = $('input[name="_token"]').val();
			jQuery.ajax({
				type: "GET",
				url: "/parties/delete_party",
				data: {DelID : DelID},
				cache: false,
				success: function(response)
				{
					if(response == "2")
					{
						jQuery("#row_"+DelID).hide();	
						$("#myModal").modal('hide');
					}
				}
			});
		});
	   //  $(document).on('click','.deleteRecord',function(e){
				// var DelID = jQuery(this).attr("id");
				// var token = $('input[name="_token"]').val();
				// $("#dialog-confirm-delete").dialog({
				// 				resizable: false,
				// 				height:170,
				// 				width: 400,
				// 				modal: true,
				// 				title: 'Delete Party',
				// 				buttons: {
				// 					Delete: function() {
				// 						$(this).dialog('close');
				// 						$.ajax({
    //                       type: "GET",
    //                   				url: '/parties/delete_party',
    //                       data: { DelID: DelID }
    //                   }).done(function( msg ) {
    //                       //alert( msg+'ttttt' );
    //                       if(msg == "delete")
    //                         $("#row_"+DelID).remove();
    //                   });
				// 					},
				// 					Cancel: function() {
				// 					   $(this).dialog('close');
				// 					}
				// 				}
				// 			});
									   
				// 		return false;
				// 		});
	} );
	</script>
@endsection
