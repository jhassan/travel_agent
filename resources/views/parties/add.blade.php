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
					<legend>Create Vendor/Client</legend>
				</div>	
				<div class="form-group col-sm-3">
					<label>Company Name</label>
					<input class="form-control" maxlength="100" placeholder="Company Name" name="name" type="text" value="{{ Input::old('name') }}">
				</div>
				<div class="form-group col-sm-3">
					<label>Phone #</label>
					<input class="form-control"  data-mask="0999-9999999" data-mask-placeholder="#" placeholder="Phone #" maxlength="11" name="phone_no" type="text" value="{{ Input::old('phone_no') }}">
				</div>

				<div class="form-group col-sm-3">
					<label>PTCL #</label>
					<input class="form-control"  data-mask="099-9999999" data-mask-placeholder="#" placeholder="PTCL #" maxlength="11" name="ptcl_no" type="text" value="{{ Input::old('ptcl_no') }}">
				</div>
                
                <div class="form-group col-sm-3">
					<label>Email</label>
					<input class="form-control" placeholder="Email"  name="email_address" type="text" value="{{ Input::old('email_address') }}">
				</div>

				<div class="form-group col-sm-3">
					<label>Address</label>
					<input class="form-control" placeholder="Address" maxlength="150" name="address" type="text" value="{{ Input::old('address') }}">
				</div>

				<div class="form-group col-sm-3">
					<label>City</label>
					<input class="form-control" placeholder="City" maxlength="15" name="city" type="text" value="{{ Input::old('city') }}">
				</div>
				
                <div class="form-group col-sm-3">
					<div>
  						<label>Account</label>
						<div class="bfh-selectbox" data-name="account_id" data-value="{{ Input::old('account_id') }}" data-filter="true">
						  <div data-value="">Select Account</div>
						  <div data-value="100000">Bank/Card</div>
						  <div data-value="200000">Clients/Receiveable</div>
                          <div data-value="300000">Vender/Payable</div>
                          <div data-value="400000">Expence</div>
                          <div data-value="500000">Profit &amp; loss</div>
                          <div data-value="600000">General</div>
						</div>
  					</div>
				</div>
                
                <div class="form-group col-sm-3">
					<div>
  						<label>Party Type</label>
						<div class="bfh-selectbox" data-name="type_id" data-value="{{ Input::old('type_id') }}" data-filter="true">
						  <div data-value="">Select Type</div>
						  <div data-value="1">Client</div>
						  <div data-value="2">Vendor</div>
						</div>
  					</div>
				</div>
				<div class="form-group col-sm-3">
					<label>Debit</label>
					<input class="form-control number_only" placeholder="Debit" maxlength="15" name="coa_debit" type="text" value="{{ Input::old('coa_debit') }}">
				</div>
				<div class="form-group col-sm-3">
					<label>Credit</label>
					<input class="form-control number_only" placeholder="Credit" maxlength="15" name="coa_credit" type="text" value="{{ Input::old('coa_credit') }}">
				</div>
			</fieldset>
			<div class="form-group col-sm-3">
		      <button type="submit" class="btn btn-primary">Save</button>
		    </div>
		</form>
		</div>

	</div>
</div>
@endsection