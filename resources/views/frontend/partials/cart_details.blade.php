@php
    $totalcartitem = 0;
@endphp
<div class="" >
       @if(Session::has('cart'))
            <div class="subtitle h6">
                <div class="d-inline-block">
                    My Cart<br>
                    @foreach (Session::get('cart') as $key => $cartItem)
    @php
        
        
        $totalcartitem += $cartItem['quantity'];
        
    @endphp
    
    
@endforeach 
@if($totalcartitem> 0)
                   <p class="small text-mute">{{ $totalcartitem }} Items</p>
                   @endif
    
                
                                
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush mb-4">
                         @php
                                        $total = 0;
                                        @endphp
                                        @foreach (Session::get('cart') as $key => $cartItem)
                                            @php
                                            $product = \App\Product::find($cartItem['id']);
                                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                                            $product_name_with_choice = $product->name;
                                            if ($cartItem['variant'] != null) {
                                                $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                                            }
                                            // if(isset($cartItem['color'])){
                                            //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                                            // }
                                            // foreach (json_decode($product->choice_options) as $choice){
                                            //     $str = $choice->name; // example $str =  choice_0
                                            //     $product_name_with_choice .= ' - '.$cartItem[$str];
                                            // }
                                            @endphp
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button onclick="removeFromCartView(event, {{ $key }})" class="btn btn-sm btn-link p-0 float-right"><i style="color:red" class="material-icons">remove_circle</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img loading="lazy"  src="{{ my_asset($product->thumbnail_img) }}" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">{{ $product_name_with_choice }} </a>
                                    <h5 class="text-success font-weight-normal mb-0">{{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}</h5>
                                    <!--<p class="text-secondary small text-mute mb-0">1.0 kg </p>-->
                                </div>
                                
                               
                                @if($cartItem['digital'] != 1)
                                <div class="col-auto align-self-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light-grey px-1 btn-number" type="button" data-type="minus" data-field="quantity[{{ $key }}]"><i class="material-icons">remove</i></button>
                                        </div>
                                        <input type="text" name="quantity[{{ $key }}]" class="form-control disabled w-35" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="{{ $product->current_stock }}" onchange="updateQuantity({{ $key }}, this)" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-light-grey px-1 btn-number" type="button" data-type="plus" data-field="quantity[{{ $key }}]"><i class="material-icons">add</i></button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                
                            </div>
                        </li>
                        
                        @endforeach
                        
                    </ul>
                </div>
            </div>

            
            @include('frontend.partials.cart_summary')
            
            


        @else
                <div class="dc-header">
                    <h3 class="heading heading-6 strong-700">{{ translate('Your Cart is empty')}}</h3>
                </div>
        @endif
        </div>



<script type="text/javascript">
    cartQuantityInitialize();
</script>
