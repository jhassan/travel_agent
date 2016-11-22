@extends('layouts.app')

@section('content')
<div class="col-md-9">
	<div class="content-box-large">
		<div class="panel-heading">
			<legend>View Profile</legend><a href="/profiles/{{ $arrayProfiles[0]->id }}/edit" class="btn btn-primary">Edit</a>
		</div>
		@if (Session::has('message_update'))
		   <div class="alert alert-info">{{ Session::get('message_update') }}</div>
		@endif
		<div class="panel-body">
		@foreach($arrayProfiles as $profile)
			<div class="col-md-12">
				<div class="col-md-8">
					<h5 class="col-md-4"><strong>Company Name:<strong></h5>
					<h5 class="col-md-6">{{ $profile->name }}</h5>
					<div class="clear"></div>
					<h5 class="col-md-4"><strong>Slogon:</h5>
					<h5 class="col-md-6">{{ $profile->slogon }}</h5>
					<div class="clear"></div>
					<h5 class="col-md-4"><strong>Address:</h5>
					<h5 class="col-md-6">{{ $profile->address }}</h5>
					<div class="clear"></div>
					<h5 class="col-md-4"><strong>Email:</h5>
					<h5 class="col-md-6">{{ $profile->email }}</h5>
					<div class="clear"></div>
					<h5 class="col-md-4"><strong>Mobile #:</h5>
					<h5 class="col-md-6">{{ $profile->cell_no }}</h5>
					<div class="clear"></div>
					<h5 class="col-md-4"><strong>PTCL #:</h5>
					<h5 class="col-md-6">{{ $profile->cell_no }}</h5>
					<div class="clear"></div>
					<h5 class="col-md-4"><strong>Website:</h5>
					<h5 class="col-md-6">{{ $profile->website }}</h5>
				</div>
				<div class="col-md-4">
					<img src="/profile_images/{{ $profile->image }}" class="img-responsive" alt="Responsive image">
				</div>
				<div class="clear"></div>
			</div>
		@endforeach
		</div>
	</div>
</div>
@endsection

