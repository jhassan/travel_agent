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
			<form role="form" method="POST" action="{{ url('/users/add_new') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<fieldset>
				<div class="panel-heading">
					<legend>Create User</legend>
				</div>	
				<div class="form-group col-sm-3">
					<label>Name</label>
					<input class="form-control" maxlength="100" placeholder="User Name" name="name" type="text" value="{{ Input::old('name') }}">
				</div>
                
                <div class="form-group col-sm-3">
					<label>Email</label>
					<input class="form-control" placeholder="Email"  name="email" type="text" value="{{ Input::old('email') }}">
				</div>

                <div class="form-group col-sm-3">
					<label>Password</label>
					<input class="form-control" placeholder="Password" id="password" name="password" type="password" value="{{ Input::old('password') }}">
				</div>

                <div class="form-group col-sm-3">
					<label>Re-type Password</label>
					<input class="form-control" placeholder="Re-type Password" id="re_type_Password" name="re_type_Password" type="password" value="{{ Input::old('re_type_Password') }}">
					<span id="pass_error" class="hidden text-danger">Passwords do not match</span>
				</div>

				<div class="form-group col-sm-3">
					<label>Phone #</label>
					<input class="form-control"  data-mask="0999-9999999" data-mask-placeholder="#" placeholder="Phone #" maxlength="11" name="user_phone_no" type="text" value="{{ Input::old('user_phone_no') }}">
				</div>

				<div class="form-group col-sm-3">
					<label>User Type</label>
					<input class="form-control" placeholder="User Type" name="user_type" type="text" value="{{ Input::old('user_type') }}">
				</div>
				<div class="form-group col-sm-3">
					<div>
  						<label>User Type</label>
						<div class="bfh-selectbox" data-name="user_type" data-value="" data-filter="true">
						  <div data-value="">Select User</div>
						  <div data-value="0">Admin</div>
						  <div data-value="1">Client</div>
						</div>
  					</div>
				</div>
				<div class="clear"></div>

				@foreach($patentPermission as $parent)
				<div class="form-group col-sm-12">
					<label style="font-size: 14px;">{{ ucfirst($parent->name) }}</label>
					<div class="clear"></div>
					@foreach($childPermission as $child)
						@if($child->parent_id == $parent->id)
						<div class="col-sm-3" style="padding-left: 0px;">
							<p style="padding-left: 0px;" class="text-left col-sm-9">{{ ucfirst($child->name) }}</p>
							<input name="permission[{{$child->id}}]" type="checkbox" value="{{ $child->id }}" id="{{ $child->id }}">
						</div>
						@endif
					@endforeach
				</div>
				<div class="clear"></div>
				@endforeach;
                
                
                
			</fieldset>
			<div class="form-group col-sm-3">
		      <button type="submit" class="btn btn-primary">Save</button>
		    </div>
		</form>
		</div>

	</div>
</div>
@endsection

@section('custom_js')
	<script src="/js/jquery.ui.dialog.js"></script>
	<script src="/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables/dataTables.bootstrap.js"></script>

	<script type="text/javascript">
	$(document).ready(function() {

	    $("#re_type_Password").blur(function(){
	    	var password = $('#password').val();
	    	var re_type_Password = $('#re_type_Password').val();
		    if(re_type_Password != password){console.log('hahahah');
		    	$('#pass_error').removeClass('hidden')
		    	return false;
		    }
	    });
	});
	</script>
@endsection
