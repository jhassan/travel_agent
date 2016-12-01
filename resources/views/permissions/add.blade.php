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
			<form role="form" method="POST" action="{{ url('/permissions/add_new') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<fieldset>
				<div class="panel-heading">
					<legend>Add Permission</legend>
				</div>	
				
				<div class="form-group col-sm-3">
					<div>
  						<label>Parent</label>
						<div class="bfh-selectbox" data-name="parent_id" data-value="" data-filter="true">
						
						  <div data-value="">Select Permission</div>
						  @foreach($PermissionList as $list)
							  <div data-value="{{ $list->id }}">{{ $list->name }}</div>
						  @endforeach
						</div>
  					</div>
				</div>

				<div class="form-group col-sm-3">
					<label>Permission</label>
					<input class="form-control" maxlength="100" placeholder="Name" name="name" type="text" value="">
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