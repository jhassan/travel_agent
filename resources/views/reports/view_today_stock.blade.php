@extends('layouts.app')

@section('content')
<div class="col-md-9">
	<div class="content-box-large">
	<div class="panel-heading">
		<legend>View Today Stock</legend>
	</div>	
	<div class="panel-body">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-responsive table-bordered">
			<thead>
				<tr>
					<th width="33%">Item Name</th>
					<th width="33%">Stock In Quantity</th>
					<th width="33%">View</th>
				</tr>
			</thead>
			<tbody>
				@foreach($all_stcok as $stock)
					<tr class="odd gradeX">
						<td>{{ $stock->product_name }}</td>
						<td>{{ number_format($stock->TotalStock) }}</td>
						<td style="padding:2px;"><a href="/sale_stock/{{ $stock->product_id }}/check_item_stock_detail" class="btn btn-default" id="{{ $stock->product_id }}" target="_blank">View Detail</a></td>
					</tr>
				@endforeach
			</tbody>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="33%">Total Quantity:</th>
					<th class="text-left" width="33%">{{number_format($total_quantity)}}</th>
					<th width="33%"></th>
				</tr>
			</thead>
			</table>
			{{ $all_stcok->render() }}
			<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
		</div>	
	</div>
</div>
<style type="text/css">
table {margin-bottom: 0px !important;}
</style>

<!-- Default bootstrap modal example -->
<div class="modal fade ItemStockModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Item Details Sale/Purchase</h4>
      </div>
      <div class="modal-body" id="fill_items_details">
      	<!-- @include('dialogs.view_item_details') -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_js')
	<script src="/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    	// Fill modal with content from link href
		$(".ShowItemStockModal").on("click", function(e) {
			var id = $(this).attr('id');
			// Get Current Stock
		    $.ajax({
	              type: "GET",
	          	  url: '/sale_stock/check_item_stock_detail',
	              data: { id: id }
	          }).done(function( response ) {
	          	$(".ItemStockModal").show();
	          	console.log(response);
	          	$("#fill_items_details").html(response);
	          	//var data = JSON.parse(response);
	          	
	          });
	       //    var link = $(e.relatedTarget);
		      // $(this).find(".modal-body").load(link.attr("href"));
		});
    });
    </script>
@endsection