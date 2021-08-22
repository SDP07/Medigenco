@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('clinic.doctor.new')}}" class="btn btn-rounded btn-info pull-right">{{translate('New Timings')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Doctors')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_brands" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                   
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="mytable table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{translate('Clinic Name')}}</th>
                    <th>{{translate("Doctor's Name")}}</th>
                    
                    <th>{{ translate('Fees') }}</th>
                    <th>{{ translate('Day') }}</th>
                    <th>{{ translate('Start') }}</th>
                    <th>{{ translate('End') }}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctorClinic as $doctor)
                    <tr>
                        <td>{{ $doctor->clinic_name }}</td>
                        <td>{{$doctor->name}}</td>                        
                        
                        <td>{{ $doctor->fees }}</td>
                        <td>{{ $doctor->day }}</td>
                        <td>{{ \Carbon\Carbon::parse($doctor->startDate)->format('H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($doctor->EndDate)->format('H:i:s') }}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('clinic.doctor.edit', encrypt($doctor->main_id))}}">{{translate('Edit')}}</a></li>
                                    {{-- <li><a onclick="confi rm_modal('{{route('d.destroy', $brand->id)}}');">{{translate('Delete')}}</a></li> --}}
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
            
            </div>
        </div>
    </div>
</div>


@endsection
