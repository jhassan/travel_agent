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
			<legend>View Users</legend>
		</div>
		@if (Session::has('message_update'))
		   <div class="alert alert-info">{{ Session::get('message_update') }}</div>
		@endif
		<div class="panel-body">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
			<thead>
				<tr>
					<th>Name </th>
					<th>Email </th>
					<th>Phone #</th>
					<th>User Type</th>
					<th>User Permission</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr class="odd gradeX" id="row_{{ $user->id }}">
						<td>{{ ucfirst($user->name) }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->user_phone_no }}</td>
						<td>@if($user->user_type != '0') Client @else Admin @endif</td>
						<td><a id="{{ $user->id }}" class="ShowAllPermissions" style="cursor:pointer;">View User Permissions</a></td>
						<td class="center">
							@php
                              if (in_array("23", $array_permission)){
                            @endphp
                              <a href="/users/{{ $user->id }}/edit"><img src="/images/edit.png" alt="Edit"></a>&nbsp; &nbsp;
                            @php
                            }
                              if (in_array("25", $array_permission)){
                            @endphp
                              <a id="{{ $user->id }}" class="deleteRecord"><img src="/images/delete.png" alt="Delete" style="cursor:pointer;" data-target="#myModal" data-toggle="modal"></a></td>
                            @php } @endphp
						</tr>
				@endforeach
			</tbody>
			</table>
			<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="view_dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Permissions</h4>
      </div>
      <div class="modal-body ShowData">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
				url: "/users/delete_user",
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
				// 				title: 'Delete User',
				// 				buttons: {
				// 					Delete: function() {
				// 						$(this).dialog('close');
				// 						$.ajax({
    //                       type: "GET",
    //                   				url: '/users/delete_user',
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
	// Show permissions dialog	    
	$(document).on('click','.ShowAllPermissions',function(e){
		var ID = $(this).attr("id");
		$.ajax({
		type: 'GET',
		url: '/users/view_permissions',
		data: {'ID' : ID},
		success: function(result)
		{
			if(result){
				$(".ShowData").html(result);
				$("#view_dialog").modal('show');
			}
		}
		});
		});	    
	} );
	</script>
@endsection
