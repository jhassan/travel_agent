@extends('layouts.app')

@section('content')
<div class="col-md-9">
	<div class="content-box-large">
	<div class="panel-heading">
		<legend>View Journal Ledger</legend>
	</div>	
	<div class="panel-body">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>{{ $coa_code }}</th>
					<th>@if(!empty($arrayLedeger[0]->coa_account)) {{ $arrayLedeger[0]->coa_account  }} @endif</th>
					<th>Date From</th>
					<th>{{ date("d-m-Y", strtotime($start_date)) }}</th>
					<th>Date To</th>
					<th>{{ date("d-m-Y", strtotime($end_date)) }}</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>Opening Balance</th>
					<th>{{ number_format( $OpeningBalance ) }}</th>
					
				</tr>
			</thead>
			<tbody>
			</tbody>
			</table>	
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Date</th>
					<th>Details</th>
					<th>Voucher Type</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Balance</th>
				</tr>
			</thead>
			<tbody>
				@php $Debit = 0; $Credit = 0 @endphp
				@foreach($arrayLedeger as $ledeger)
					@php $OpeningBalance = $OpeningBalance + $ledeger->purchase_debit_amount - $ledeger->purchase_credit_amount @endphp
					<tr class="odd gradeX" id="row_{{ $ledeger->id }}">
						<td>{{ date("d-m-Y", strtotime($ledeger->purchase_date)) }}</td>
						<td>{{ $ledeger->purchase_descriptions }}</td>
						<td>{{ $ledeger->voucher_type }}</td>
						<td class="text-right">{{ number_format( $ledeger->purchase_debit_amount ) }}</td>
						<td class="text-right">{{ number_format( $ledeger->purchase_credit_amount ) }}</td>
						<td class="text-right">{{ number_format( $OpeningBalance ) }}</td>
					</tr>
					@php
						$Debit += $ledeger->purchase_debit_amount;
						$Credit += $ledeger->purchase_credit_amount;
					@endphp
				@endforeach
					@php $TotalBalnce = ($OpeningBalance + $Debit) - $Credit; @endphp
				<tr>
					<td colspan="3" class="text_bold">Total</td>
					<td class="text-right text_bold">{{ number_format( $Debit ) }}</td>
					<td class="text-right text_bold">{{ number_format( $Credit ) }}</td>
					<td class="text-right text_bold">{{ number_format( $OpeningBalance ) }}</td>
				</tr>
			</tbody>
			</table>
			<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
		</div>	
	</div>
</div>
<style type="text/css">
table {margin-bottom: 0px !important;}
</style>
@endsection

@section('custom_js')

	<script src="/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables/dataTables.bootstrap.js"></script>
	
@endsection