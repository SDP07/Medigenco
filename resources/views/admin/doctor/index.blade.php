@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('doctors.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Doctor')}}</a>
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
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Specialization')}}</th>
                    <th>{{translate('Qualification')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                @php
                    $spec = App\Specialization::where('id',$doctor->special_id)->first();
                @endphp
                    <tr>
                       
                        
                        <td><a href="#" class="doctorDet" data-toggle="modal" data-target="#exampleModal" data-id="{{ $doctor->id }}">{{$doctor->Name}}</a></td>                        
                        <td>{{ $spec->name }}</td>
                        <td>{{ $doctor->qualification }}</td>
                       
                       
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('doctors.edit', encrypt($doctor->id))}}">{{translate('Edit')}}</a></li>
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
        <h5 class="modal-title" id="exampleModalLabel">Clinic Timings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table table-striped">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Clinic Name</th>
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
            $('.doctorDet').on('click',function(){
                var dataId = $(this).attr("data-id");
                $.ajax({
                    url:"{{ route('doctor.clinic') }}",
                    method:"GET",
                    data:{'id':dataId},
                    success:function(response){
                        var html = '';
                        $.each(response.doctorClinic, function(index, val) {
                             html +='<tr>';
                             html +='<td>'+ val.name + '</td>';
                             html +='<td>'+ val.clinic_name + '</td>';
                             html +='<td>'+ val.fees + '</td>';
                             html +='<td>'+ val.day + '</td>';
                             html +='<td>'+ val.start + '</td>';
                             html +='<td>'+ val.end + '</td>';
                             html +='</tr>';
                            
                            
                        });
                        $('.doctoDetails').html(html);
                    },
                    error:function(response){
                       $('.doctoDetails').html('<tr><td>No Data Found</td></tr>');
                    }
                });
            });
             $('.mytable').DataTable();
        });
    </script>
@endsection
