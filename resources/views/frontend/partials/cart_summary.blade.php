@php
    $total_point = 0;
@endphp
@foreach (Session::get('cart') as $key => $cartItem)
    @php
        $product = \App\Product::find($cartItem['id']);
        $total_point += $product->earn_point*$cartItem['quantity'];
    @endphp
@endforeach
@php
    $subtotal = 0;
    $tax = 0;
    $shipping = 0;
@endphp
@php
    $subtotal = 0;
    $tax = 0;
    $shipping = 0;
@endphp
@foreach (Session::get('cart') as $key => $cartItem)
    @php
        $product = \App\Product::find($cartItem['id']);
        $subtotal += $cartItem['price']*$cartItem['quantity'];
        $tax += $cartItem['tax']*$cartItem['quantity'];
        $shipping += $cartItem['shipping'];

        $product_name_with_choice = $product->name;
        if ($cartItem['variant'] != null) {
            $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
        }
    @endphp
    
@endforeach
<div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <span class="btn btn-success p-3 rounded-circle" data-toggle="modal" data-target="#modalCoupon">
                                <i class="material-icons">local_activity</i>
                            </span>
                        </div>
                        
         @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
            @if (Session::has('coupon_discount'))
               
               <form style="display: contents;" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                        <div class="col">
                            <div class="form-group mb-0 float-label active">
                                <input type="text" class="form-control"  value="{{ \App\Coupon::find(Session::get('coupon_id'))->code }}" disabled>
                                <label class="form-control-label">Applied Coupon Code</label>
                            </div>
                        </div>
                        <div class="col-auto align-self-center">
                            <button style="border-radius:120px" class="btn shadow btn-base-1"><i class="material-icons">remove_circle</i></button>
                        </div>
                </form>
            @else
                
                <form style="display: contents;" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col">
                 
                        <div class="form-group mb-0 float-label active">
                            <input type="text" class="form-control" required="" name="code" placeholder="{{translate('Enter Coupon Code')}}">
                            <label class="form-control-label"></label>
                        </div>
                 
                    </div>
                    <div class="col-auto align-self-center">
                        <button type="submit" style="border-radius:120px" class="btn shadow btn-base-1"><i class="material-icons">arrow_forward</i></button>
                    </div>
                </form>
            @endif
        @endif
        
        <!--Section: Live preview-->



<!--Modal: modalCoupon-->
  <div class="modal fade top" id="modalCoupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-frame modal-top modal-notify modal-success" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Body-->
        <div class="modal-body">
          <div class="row d-flex justify-content-center align-items-center">
              @php
$cps = App\Models\Coupon::where('discount_type', 'amount')->get();
$cps2 = App\Models\Coupon::where('discount_type', 'percent')->get();


@endphp
            <table class="table table-borderless ml-2 mr-2">
  <thead>
    <tr>
     
      <th scope="col">Offers</th>
      <th scope="col">Code</th>
      
    </tr>
  </thead>
  
  <tbody>
    <tr style="background-color: aquamarine;color:white">
    @foreach ($cps as $cpis)
    @php
    $cpijson = $cpis->details;
    $arrc1 = json_decode($cpijson, true);
    @endphp
      <td>Rs. {{ $cpis->discount }} Off On Order Above Rs.{{ $arrc1["min_buy"] }} </td>
      <td><h2><span style="font-size: 15px;" class="badge badge-primary">{{ $cpis->code }}</span></h2></td>
      
    @endforeach  
    </tr>
    
    <tr style="background-color: lavender;color:white">
    @foreach ($cps2 as $cpis2)
    @php
    $cpijson2 = $cpis2->details;
    $arrc2 = json_decode($cpijson2, true);
    @endphp
      <td>{{ $cpis2->discount }}% Off On Order Above RS.{{ $arrc2["min_buy"] }} </td>
      <td><h2><span style="font-size: 15px;" class="badge badge-primary">{{ $cpis2->code }}</span></h2></td>
      
    @endforeach  
    </tr>
   
  </tbody>
</table>
          </div>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!--Modal: modalCoupon-->

  <!--Section: Live preview-->
                        
                        
                        
                    </div>
                </div>

                <div class="card-body border-top-dashed">
                    <div class="row ">
                        <div class="col-5">
                            <p class="text-secondary mb-1 small">Sub Total</p>
                            <h5 class="mb-0">{{ single_price($subtotal) }}</h5>
                        </div>
                        <div class="col-2 text-center">
                            <p class="text-secondary mb-1 small"></p>
                            <h5 class="mb-0"></h5>
                        </div>
                        
                        <div class="col-5 text-right">
                            <p class="text-secondary mb-1 small">Discount</p>
                            @if (Session::has('coupon_discount'))
                            <h5 class="mb-0">-{{ single_price(Session::get('coupon_discount')) }}</h5>
                             @endif
                        </div>
                        
                    </div>

                </div>
            </div>
            
            <div class="card mb-4 border-0 shadow-sm border-top-dashed">
                <div class="card-body text-center">
                    <p class="text-secondary my-1">Net Payable</p>
                    
                @php
                    $total = $subtotal+$tax;
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                @endphp
                    <h3 class="mb-0">{{ single_price($total) }}</h3>
                    <br>
                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow  btn-styled btn-base-1"><span>Checkout</span><i class="material-icons">arrow_forward</i></a>
                </div>
            </div>



