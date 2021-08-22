@extends('layouts.app')

@section('content')
@if(Auth::user()->user_type == 1)
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('Appoints')}}</div>
                </div>
                <div class="pad-ver mar-top text-main">
                    <i class="demo-pli-data-settings icon-4x"></i>
                </div>
                <br>
                <p class="text-lg text-main"><strong>{{translate('Appontments')}}</strong></p>
                
                <p class="text-lg text-main">{{translate('Total Appontments')}}: <span class="text-bold">{{ App\Appointment::count() }}</span></p>
                <br>
                <a href="#" class="btn btn-primary mar-top">{{ translate('Check Appontments') }} <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total Pending Appontments')}}</p>
                        <p class="text-semibold text-3x text-main">{{ App\Appointment::where('approve',0)->count() }}</p>
                        <a href="#" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Check Appontmetns')}}</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total Available Location')}}</p>
                        <p class="text-semibold text-3x text-main">{{ App\Location::count() }}</p>
                        <a href="#" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create a new package')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total Active/In-active Appontments')}}</p>
                        <p class="text-semibold text-3x text-main">{{ App\Appointment::where('approve','>',0)->count() }}</p>
                        <a href="#" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create Sub Category')}}</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total Banners')}}</p>
                        <p class="text-semibold text-3x text-main">{{ App\Banner::count() }}</p>
                        <a href="#" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Clients Found')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if((Auth::user()->userType == 1))
    <div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('Agents')}}</div>
                </div>
                <br>
                <p class="text-normal text-main">{{translate('Total Agents')}}</p>
                <p class="text-semibold text-3x text-main">#</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Agents')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total approved Agents')}}</p>
                <p class="text-semibold text-3x text-main">#</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Agents')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total pending Agents')}}</p>
                <p class="text-semibold text-3x text-main">#</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Agents')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Vendors --}}
@if((Auth::user()->user_type == 1))
    <div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('Clinics')}}</div>
                </div>
                <br>
                <p class="text-normal text-main">{{translate('Total Clinic')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\Clinic::count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Clinics')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total Doctors')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\Doctor::count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Doctors')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total Hospitals')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\Hospital::count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Hospitals')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('Client')}}</div>
                </div>
                <br>
                <p class="text-normal text-main">{{translate('Total Clients')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\User::where('user_type',7)->count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Clients')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total Diagnostic Centres')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\User::where('user_type',5)->count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Diagnostic Centres')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total Ambulance Agencies')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\User::where('user_type',6)->count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Agencies')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->user_type == 2)
    <div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('')}}</div>
                </div>
                <br>
                <p class="text-normal text-main">{{translate('Total Appointments')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\Appointment::count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Manage Appointments')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Pending Appointments')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\Appointment::where('approve',0)->count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Check Appontments')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Active Appointments')}}</p>
                <p class="text-semibold text-3x text-main">{{ App\Appointment::where('approve',1)->count() }}</p>
                <br>
                <a href="#" class="btn-link">{{translate('Check Appontments')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
@endif


@if(Auth::user()->user_type == 'admin')
    <div class="flex-row">
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Activation')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="#" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('SMTP')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('smtp_settings.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Payment method')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('payment_method.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Social media')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('social_login.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-12 flex-col-12">
        <div class="panel">
            <div class="panel-body text-center dash-widget bg-primary">
                <br>
                <br>
                <i class="demo-pli-gear icon-5x"></i>
                <br>
                <br>
                <br>
                <br>
                <p class="text-semibold text-2x text-light mar-ver">
                    {{translate('Business')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Currency')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{route('currency.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no ">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Seller verification')}} <br>
                    {{translate('form setting')}}
                </p>
                <br>
                <a href="{{route('seller_verification_form.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Language')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{route('languages.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Seller commission')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('business_settings.vendor_commission') }}" class="btn btn-primary mar-top btn-block">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
