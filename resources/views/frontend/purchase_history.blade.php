@extends('frontend.layouts.app')

@section('content')
<br>
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{ translate('Purchase History')}}
                                    </h2>
                                </div>
                               
                            </div>
                        </div>

                        @if (count($orders) > 0)
                            <!-- Order history table -->
                            @foreach ($orders as $key => $order)
                               @if (count($order->orderDetails) > 0)
                            <div style="background-color: lemonchiffon;" class="card no-border mt-1" onclick="show_purchase_history_details({{ $order->id }})">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        
                                        <tbody>
                                            
                                                <tr>
                                                    
                            <span class="ml-4 pt-4">
                                <i style="color:green;font-size:40px" class="material-icons">store_mall_directory</i>
                                &nbsp  <span style="font-size:18px">Amount: {{ single_price($order->grand_total) }}</span>
                            <span>
                        
                                                    <p style="padding: 10px;margin-bottom: -10px;font-size: 15px;">
                                                <span>Order Id: <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">HGR{{ mt_rand(100,999) }}{{ date('dY') }}</a></span><br>
                                                <span>Date: {{ date('d-m-Y', $order->date) }}</span>
                                                </p>
                                                </tr>
                                                    <tr >  
                                                       
                                                       
                                                        
                                                    </tr>
                                                    @php
    $status = $order->orderDetails->first()->delivery_status;
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp
                                                    <div class="pt-2" style="background-color: beige;">
        <ul class="process-steps clearfix">
            <li @if($status == 'pending') class="active" @else class="done" @endif>
                <div style="background: green;" class="icon">1</div>
                <div class="title">{{ translate('Proccessing')}}</div>
            </li>
            <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                <div style="background: green;" class="icon">2</div>
                <div class="title">{{ translate('On review')}}</div>
            </li>
            <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done" @endif>
                <div style="background: green;" class="icon">3</div>
                <div class="title">{{ translate('On delivery')}}</div>
            </li>
            <li @if($status == 'delivered') class="done" @endif>
                <div style="background: green;" class="icon">4</div>
                <div class="title">{{ translate('Delivered')}}</div>
            </li>
        </ul>
    </div>
                                               
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                             <hr></hr>
                             @endif
                         @endforeach
                        @endif

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $orders->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Make Payment')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="payment_modal_body"></div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>

@endsection
