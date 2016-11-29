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
			<form role="form" method="POST" action="{{ url('/parties/add_new') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<fieldset>
				<div class="panel-heading">
					<legend>Create Receive Voucher</legend>
				</div>	
				<div class="form-group col-sm-3" id="div_departre_date">
					<label>Date</label>
					<div class="bfh-datepicker" data-name="date" data-format="d-m-y" data-date="today">
						<div class="input-group bfh-datepicker-toggle" data-toggle="bfh-datepicker">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="text" name="date" class="form-control" placeholder="" readonly="">
						</div>
					</div>
				</div>
				<div class="clear"></div>


				<div class="form-group col-sm-3">
					<div>
  						<label>Banks</label>
						<div class="bfh-selectbox" data-name="bank_name" data-value="" data-filter="true">
						  <div data-value="">Select Account</div>
						  @foreach($bankLists as $bank)
						  	<div data-value="{{ $bank->coa_code }}">{{ $bank->coa_account }}</div>
						  @endforeach
						</div>
  					</div>
				</div>

				<div class="form-group col-sm-3">
					<div>
  						<label>Client</label>
						<div class="bfh-selectbox" data-name="client_name" data-value="" data-filter="true">
						  <div data-value="">Select Account</div>
						  @foreach($clientLists as $client)
						  	<div data-value="{{ $client->name }}">{{ $client->name }}</div>
						  @endforeach
						</div>
  					</div>
				</div>

				<div class="form-group col-sm-3">
					<label>Description</label>
					<input class="form-control"  placeholder="Discription" name="description" type="text" value="">
				</div>

				<div class="form-group col-sm-3">
					<label>Ammount</label>
					<input class="form-control"  placeholder="Ammount" name="ammount" type="text" value="">
				</div>


<!-- 				<div class="form-group col-sm-3">
					<label>Debit</label>
					<input class="form-control number_only" placeholder="Debit" maxlength="15" name="coa_debit" type="text" value="">
				</div>
				<div class="form-group col-sm-3">
					<label>Credit</label>
					<input class="form-control number_only" placeholder="Credit" maxlength="15" name="coa_credit" type="text" value="">
				</div> -->
			</fieldset>
			<div class="form-group col-sm-3">
		      <button type="submit" class="btn btn-primary">Save</button>
		    </div>
		</form>
		</div>

	</div>
</div>
@endsection