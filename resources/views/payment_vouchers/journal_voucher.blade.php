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
					<legend>Create Journal Voucher</legend>
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
					<label>Description</label>
					<input class="form-control"  placeholder="Discription" name="description" type="text" value="">
				</div>

				<div class="form-group col-sm-3">
					<label>Ammount</label>
					<input class="form-control number_only"  placeholder="Ammount" name="ammount" type="text" value="">
				</div>


				<div class="form-group col-sm-2">
					<label>Debit</label>
					<input class="form-control number_only" placeholder="Debit" maxlength="15" name="debit" type="text" value="">
				</div>
				<div class="form-group col-sm-2">
					<label>Credit</label>
					<input class="form-control number_only" placeholder="Credit" maxlength="15" name="credit" type="text" value="">
				</div>
				<div class="form-group col-sm-2" style="margin-top: 21px;">
					<span id="add_btn" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i></span>
				</div>
				<div id="result_add_btn"> </div>
				

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
	<script type="text/javascript">
		$("#add_btn").on('click', function () {
			
        var str = "";
        {

        str = "<div class='col-lg-12 m-b-15' >";
			  str += "<div class='box-body col-sm-3 p-l-0'>";
				str += "<label> Description </label>";
				str += "<input type='text' class='form-control' name=\"description[]\" placeholder=\"Description\" >";
			  str += "</div>";
			  str += "<div class='box-body col-sm-3 p-l-0'>";
				str += "<label> Ammount </label>";
				str += "<input type='text' class='form-control' name=\"ammount[]\" placeholder=\"Ammount\">";
			  str += "</div>";
			  str += "<div class='box-body col-sm-2 p-r-0'>";
				str += "<label> Debit </label>";
				str += "<input type='text' class='form-control' name=\"debit[]\" placeholder=\"Debit\">";
			  str += "</div>";
			  str += "<div class='box-body col-sm-2 p-r-0'>";
				str += "<label> Credit </label>";
				str += "<input type='text' class='form-control' name=\"credit[]\" placeholder=\"Credit\">";
			  str += "</div>";
		  str += "</div>";

        /*str = "<div class='col-sm-12'>";	
          str += "<div class='box-body col-sm-3'>";
			str += "<label> Description </label>";
			str += "<input type='text' class='form-control' name=\"description[]\" placeholder=\"Description\" >";
		  str += "</div>";
		  str = "<div class='box-body col-sm-3'>";
			str += "<label> Ammount </label>";
			str += "<input type='text' class='form-control number_only' maxlength=\"15\"  name=\"ammount[]\" placeholder=\"Ammount\" >";
		  str += "</div>";
		  str = "<div class='box-body col-sm-3'>";
			str += "<label> Debit </label>";
			str += "<input type='text' class='form-control number_only' maxlength=\"15\" name=\"debit[]\" placeholder=\"Debit\" >";
		  str += "</div>";
		  str = "<div class='box-body col-sm-3'>";
			str += "<label> Credit </label>";
			str += "<input type='text' class='form-control number_only' maxlength=\"15\" name=\"credit[]\" placeholder=\"Credit\" >";
		  str += "</div>";
		str += "</div>";*/

			
$('#result_add_btn').append(str);
        }
    });
	</script>
@endsection		