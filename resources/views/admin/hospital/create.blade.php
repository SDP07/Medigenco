@extends('layouts.app')

@section('content')
<div>
    <h1 class="page-header text-overflow">{{ translate('Add New Hospital') }}</h1>
</div>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="{{route('hospitals.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
			@csrf
			<input type="hidden" name="added_by" value="admin">
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Hospital Information')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Client Name')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="name" placeholder="{{ translate('Client Name') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Phone')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="phone" placeholder="{{ translate('Phone Number') }}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Personal Address')}}</label>
						<div class="col-lg-7">
							<textarea class="form-control" name="perAddress" placeholder="{{ translate('Personal Address') }}" cols="7"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Postal Code')}}</label>
						<div class="col-lg-7">
							<input type="Number" class="form-control" name="postal" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('City')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="city" required>
						</div>
					</div>
                   
					
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{translate('Location')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="location_id" id="category_id" required>
								@foreach($locations as $location)
									<option value="{{$location->id}}">{{__($location->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>
					 <div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Password')}}</label>
						<div class="col-lg-7">
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Email')}} </t> <small><span style="color: red">(Optional)</span></small></label>
						<div class="col-lg-7">
							<input type="email" class="form-control" name="email">
							
						</div>
					</div>
					

					
				</div>
			</div>
			
			
		
			
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Hospital Details')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Hospital Name')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="hospital_name" placeholder="{{ translate('Hospital Name') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Hospital Address')}}</label>
						<div class="col-lg-7">
							<textarea class="form-control" name="cliAddress" placeholder="{{ translate('Hospital Address') }}" cols="12" rows="5"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Hospital Phone')}}</label>
						<div class="col-lg-9">
							<input type="number" class="form-control" name="clinPhone"  placeholder="{{ translate('Hospital Phone Number') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Alternate')}}</label>
						<div class="col-lg-9">
							<input type="number" class="form-control" name="alternate"  placeholder="{{ translate('Alternate Number') }}">
						</div>
					</div>
				</div>
			</div>
           
			
			
			<div class="mar-all text-right">
				<button type="submit" name="button" class="btn btn-info">{{ translate('Save') }}</button>
			</div>
		</form>
	</div>
</div>


@endsection


