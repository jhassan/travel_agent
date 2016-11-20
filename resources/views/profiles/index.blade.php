@extends('layouts.app')

@section('content')
<div class="col-md-9">
	<div class="content-box-large">
		<div class="panel-heading">
			<legend>View Profile</legend>
		</div>
		@if (Session::has('message'))
		   <div class="alert alert-info">{{ Session::get('message') }}</div>
		@endif
		<div class="panel-body">
		@foreach($arrayProfiles as $profile)
			<dir class="col-md-6">
				<dir class="col-md-6"><strong>Name:</strong> </dir>
				<dir class="col-md-6">{{ $profile->name }}</dir>
			</dir>
		@endforeach
			<dir class="col-md-6"></dir>
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
