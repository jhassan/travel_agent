@extends('layouts.app')

@section('content')
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
					<th>Password </th>
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
						<td> xxxxxxxx </td>
						<td>@if($user->user_type != '0') Client @else Admin @endif</td>
						<td>{{ $user->user_permission }}</td>
						<td class="center"><a href="/users/{{ $user->id }}/edit"><img src="/images/edit.png" alt="Edit"></a>&nbsp; &nbsp;<a id="{{ $user->id }}" class="deleteRecord"><img src="/images/delete.png" alt="Delete" style="cursor:pointer;"></a></td>
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
