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
		@if (Session::has('message'))
		   <div class="alert alert-info">{{ Session::get('message') }}</div>
		@endif
		<div class="panel-body">
			<form role="form" method="POST" action="{{ url('/accounts/view_ledger') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<fieldset>
				<div class="panel-heading">
					<legend>Journal Ledger</legend>
				</div>	
				<div class="form-group col-sm-3">
					<div>
  						<label>Select Category</label>
						<div class="bfh-selectbox hide" data-name="category_id" id="category_id" data-value="" data-filter="true">
						  <div data-value="">Select Category</div>
						  @foreach($array_category as $category)
						  	<div data-value="{{ $category->id }}">{{ $category->category_name }}</div>
						  @endforeach
						</div>
  					</div>
				</div>
				<div class="form-group col-sm-3">
					<div>
  						<label>Select COA</label>
						<div class="bfh-selectbox hide" data-name="coa_code" id="coa_code" data-value="" data-filter="true">
						  <div data-value="">Select Party</div>
						  @foreach($arrayParties as $party)
						  	<div data-value="{{ $party->coa_code }}">{{ $party->coa_account }}</div>
						  @endforeach
						</div>
  					</div>
				</div>
				<div class="form-group col-sm-3">
					<label>Start Date</label>
					<div class="bfh-datepicker" data-name="start_date" data-format="d-m-y" data-date="today">
						<div class="input-group bfh-datepicker-toggle" data-toggle="bfh-datepicker">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="text" name="start_date" class="form-control" placeholder="" readonly="">
						</div>
					</div>
				</div>
				<div class="form-group col-sm-3">
					<label>End Date</label>
					<div class="bfh-datepicker" data-name="end_date" data-format="d-m-y" data-date="today">
						<div class="input-group bfh-datepicker-toggle" data-toggle="bfh-datepicker">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="text" name="end_date" class="form-control" placeholder="" readonly="">
						</div>
					</div>
				</div>
			</fieldset>
			<div class="form-group col-sm-3">
		      <button type="submit" class="btn btn-primary">Search</button>
		    </div>
		</form>
		</div>

	</div>
</div>
@endsection
@section('custom_js')
	<script type="text/javascript">
		$(document).ready(function () {
			// shows drop down list when page loaded
			$("#coa_code").removeClass('hide');
			$("#category_id").removeClass('hide');
			});
	</script>
@endsection		