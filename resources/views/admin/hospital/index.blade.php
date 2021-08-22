@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('hospitals.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Hospital')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Hospital')}}</h3>
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
                    <th>{{translate('Hospital Name')}}</th>
                    <th>{{translate('Hospital Address')}}</th>
                    <th>{{translate('Hospital Phone Number')}}</th>
                    <th>{{translate('Hospital Location')}}</th>
                    <th>{{translate('Hospital Email')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hospitals as $hospital)
                
                    <tr>
                       
                        
                        <td>{{ $hospital->hospital_name }}</td>                        
                        <td>{{ $hospital->address }}</td>
                        <td>{{ $hospital->phone }}</td>
                        @php
                            $location = App\Location::where('id',$hospital->location_id)->first();
                        @endphp
                        <td>{{ $location->name }}</td>
                        @if($hospital->email == null)
                           <td> {{ translate('There is no email Available') }}</td>
                        @else
                            <td>{{ $hospital->email }}</td>
                        @endif

                       
                       
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('hospitals.edit', encrypt($hospital->id))}}">{{translate('Edit')}}</a></li>
                                   {{--  <li><a onclick="confi rm_modal('{{route('d.destroy', $brand->id)}}');">{{translate('Delete')}}</a></li> --}}
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">hospital Timings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table table-striped">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>hospital Name</th>
                <th>Fees</th><th>Day</th>
                <th>Start</th>
                <th>End</th>
            </tr>
        </thead>
        <tbody class="doctoDetails">
            
        </tbody>
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
    <script type="text/javascript">
        function sort_brands(el){
            $('#sort_brands').submit();
        }

        $(document).ready(function(){
             $('.mytable').DataTable();
        });
    </script>
@endsection
