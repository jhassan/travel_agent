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
			<form role="form" id="profile_form" method="POST" action="{{ url('profiles/add_new') }}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<fieldset>
				<div class="panel-heading">
					<legend>Create Profile</legend>
				</div>	
				<div class="form-group col-sm-3">
					<label>Name</label>
					<input class="form-control" maxlength="100" placeholder="Name" name="name" type="text" value="">
				</div>
				<div class="form-group col-sm-3">
					<label>Slogon</label>
					<input class="form-control" maxlength="100" placeholder="Slogon" name="slogon" type="text" value="">
				</div>

				<div class="form-group col-sm-3">
					<label>Cell #</label>
					<input class="form-control" data-mask="0999-9999999" data-mask-placeholder="#" placeholder="Phone #" maxlength="11" name="cell_no" type="text" value="">
				</div>

				<div class="form-group col-sm-3">
					<label>Email</label>
					<input class="form-control" placeholder="Email"  name="email" type="text" value="">
				</div>

				<div class="form-group col-sm-3">
					<label>Address</label>
					<input class="form-control" placeholder="Address" maxlength="150" name="address" type="text" value="">
				</div>

				<div class="form-group col-sm-3">
					<label>website</label>
					<input class="form-control" placeholder="Website" name="website" id="website" type="text" value="">
				</div>
				<dir class="clear"></dir>
				<div class="form-group col-sm-3">
					<input type='file' name="image"/>
  				</div>
			</fieldset>
			<div class="form-group col-sm-3">
		      <button type="button" id="submit_button" class="btn btn-primary">Save</button>
		    </div>
		</form>
		</div>

	</div>
</div>
@endsection
@section('custom_js')
	<script type="text/javascript">
	$(document).ready(function (){
		// submit form
		$("#submit_button").click(function (){
		var doma = $('#website').val();
        if(!/^(http(s)?\/\/:)?(www\.)?[a-zA-Z\-]{3,}(\.(com|net|org))?$/.test(doma))
        {
            alert('invalid website/domain name!');
            return false;
        }
        else	
			$("#profile_form").submit();
		});
	}); // end ready
</script>
@endsection
		

