@extends('layouts.app')

@section('content')
<div>
    <h1 class="page-header text-overflow">{{ translate('Add Schedule For Doctors') }}</h1>
</div>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="{{route('clinic.doctor.post')}}" method="POST" enctype="multipart/form-data" id="choice_form">
			@csrf
			<input type="hidden" name="added_by" value="admin">
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Doctor Information')}}</h3>
				</div>
				@php
					$doctors = App\Doctor::where('user_id','!=',0)->get();
					$clinics = App\Clinic::all();
				@endphp
				<div class="panel-body">
					<div class="form-group" id="category">
					<label class="col-lg-2 control-label">{{translate('Doctor Name')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="doctor_id" id="category_id" required>
								@foreach($doctors as $doctor)
									<option value="{{$doctor->id}}">{{__($doctor->Name)}}</option>
								@endforeach
							</select>
						</div>
				
					</div>
					<div class="form-group" id="category">
					<label class="col-lg-2 control-label">{{translate('Clinic Name')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="clinic_id" id="category_id" required>
								@foreach($clinics as $clinic)
									<option value="{{$clinic->id}}">{{__($clinic->clinic_name)}}</option>
								@endforeach
							</select>
						</div>
				
					</div>
				</div>
			</div>
			
		
			
			<div class="panel" id="timingDet">
				
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Dispensary Details')}}</h3>

				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Day')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="day" placeholder="{{ translate('Ex:Sunday') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Start Time')}}</label>
						<div class="col-lg-9">
							<input type="time" class="form-control" name="start" placeholder="{{ translate('Starting Time') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('End Time')}}</label>
						<div class="col-lg-9">
							<input type="time" class="form-control" name="end" placeholder="{{ translate('Ending Time') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Price')}}</label>
						<div class="col-lg-9">
							<input type="number" class="form-control" name="price"  placeholder="{{ translate('Price') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Discount')}}</label>
						<div class="col-lg-9">
							<input type="number" class="form-control" name="discount"  placeholder="{{ translate('Discount') }}">
						</div>
					</div>
				
			</div>
           
			
			
			<div class="mar-all text-right">
				<button type="submit" name="button" class="btn btn-info">{{ translate('Save') }}</button>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	

	});
</script>

@endsection


