<div class="clear"></div>
@foreach($patentPermission as $parent)
<div class="form-group col-sm-12">
	<label style="font-size: 14px;">{{ ucfirst($parent->name) }}</label>
	<div class="clear"></div>
	@foreach($childPermission as $child)
		@if($child->parent_id == $parent->id)
			@php 
				$array_permission = explode(',',$user_permission);
				if (in_array($child->id, $array_permission))
					$checked = "checked='checked'";
				else
					$checked = "";
			@endphp
			@php if(!empty($checked)) { @endphp
			<div class="col-sm-5" style="padding-left: 0px;">
				<p style="padding-left: 0px;" class="text-left col-sm-9">{{ ucfirst($child->name) }}</p>
				<input disabled class="checkedAll" {{ $checked }} name="permission[{{$child->id}}]" type="checkbox" value="{{ $child->id }}" id="{{ $child->id }}">
			</div>
			@php } @endphp
		@endif
	@endforeach
</div>
<div class="clear"></div>
@endforeach;