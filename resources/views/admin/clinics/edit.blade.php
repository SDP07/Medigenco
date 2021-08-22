@extends('layouts.app')

@section('content')
<div>
    <h1 class="page-header text-overflow">{{ translate('Add New Clinic') }}</h1>
</div>

@php

	$user = App\User::where('id',$clinic->user_id)->first();

@endphp
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="{{route('clinics.update',$clinic->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
			@csrf
			<input name="_method" type="hidden" value="PATCH">
			<input type="hidden" name="added_by" value="admin">
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Clinic Information')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Client Name')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="name" placeholder="{{ translate('Doctor Name') }}" value="{{ $user->name }}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Phone')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="phone" placeholder="{{ translate('Phone Number') }}" value="{{ $user->phone }}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Personal Address')}}</label>
						<div class="col-lg-7">
							<textarea class="form-control" name="perAddress" placeholder="{{ translate('Personal Address') }}" cols="7">{{ $user->address }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Postal Code')}}</label>
						<div class="col-lg-7">
							<input type="Number" class="form-control" name="postal" value="{{ $user->postal_code }}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('City')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="city" value="{{ $user->city }}" required>
						</div>
					</div>
                   
					
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{translate('Location')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="location_id" id="category_id" required>
								@foreach($locations as $location)
									<option value="{{$location->id}}" <?php if($location->id == $user->location_id){ echo 'selected';} ?>>{{__($location->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Email')}} </t> <small><span style="color: red">(Optional)</span></small></label>
						<div class="col-lg-7">
							<input type="email" class="form-control" name="email" value="{{ $user->email }}">
							
						</div>
					</div>
					

					
				</div>
			</div>
			
			
		
			
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Clinic Details')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Clinic Name')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="clinic_name" placeholder="{{ translate('Clinic Name') }}" value="{{ $clinic->clinic_name }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Clinic Address')}}</label>
						<div class="col-lg-7">
							<textarea class="form-control" name="cliAddress" placeholder="{{ translate('Clinic Address') }}" cols="12" rows="5">{{ $clinic->clinic_address }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Clinic Phone')}}</label>
						<div class="col-lg-9">
							<input type="number" class="form-control" name="clinPhone"  placeholder="{{ translate('Clinic Phone Number') }}" value="{{ $clinic->clinic_phone }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Alternate')}}</label>
						<div class="col-lg-9">
							<input type="number" class="form-control" name="alternate"  placeholder="{{ translate('Alternate Number') }}" value="{{ $clinic->clinic_alternate }}">
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


