@extends('layouts.app')

@section('content')
<div>
    <h1 class="page-header text-overflow">{{ translate('Edit Doctor') }}</h1>
</div>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="{{route('doctors.update',$doctor->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
			@csrf
			 <input name="_method" type="hidden" value="PATCH">
			<input type="hidden" name="added_by" value="admin">
			@php
				$user = App\User::where('id',$doctor->user_id)->first();				
			@endphp
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Doctor Information')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Name')}}</label>
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
                   
					@php
						$locations = App\Location::all();
					@endphp
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{translate('Location')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="location_id" id="category_id" required>
								@foreach($locations as $location)
									<option value="{{$location->id}}" <?php if($location->id == $doctor->location_id){echo "selected";} ?>>{{__($location->name)}}</option>
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
			
			@php 

				$specs = App\Specialization::all();

			@endphp
		
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Doctor Details')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{translate('Specialization')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="special_id" id="category_id" required>
								@foreach($specs as $spec)
									<option value="{{$spec->id}}" <?php if($spec->id == $doctor->special_id){echo "selected";} ?>>{{__($spec->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Qualification')}}</label>
						<div class="col-lg-7">
							<input type="text" placeholder="{{ translate('Qualification') }}" name="qualification" class="form-control" required value="{{ $doctor->qualification }}">
						</div>
					</div>
					
					
					
					<br>
					<div class="sku_combination" id="sku_combination">

					</div>
				</div>
			</div>
			@php

				$clinic = App\Clinic::where('user_id',$user->id)->first();

			@endphp
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Dispensary Details')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Dispensary')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="dispensary" value="{{ $clinic->clinic_name }}" placeholder="{{ translate('Dispensary Name') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Clinic Address')}}</label>
						<div class="col-lg-7">
							<textarea class="form-control" name="cliAddress" placeholder="{{ translate('Clinic Address') }}" cols="12" rows="5">value="{{ $clinic->clinic_address }}"</textarea>
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


