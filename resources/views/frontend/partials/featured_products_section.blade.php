<section class="mb-1">
    <div class="container">
        <div class="px-2 p-md-2 bg-white shadow-sm">
            <div class="">
                
            </div>
            <div class="caorusel-box arrow-round gutters-5">
                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                    @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
                    
                    <div class="caorusel-card">
                        
                        <div class="product-card-2 card card-product shop-cards shop-tech">
                            @php
                                        
                                    $disco = $product->discount;
                                    $dism = str_replace(',00', '', number_format($disco, 0, ',', '')); 
                                @endphp
                                @if ($disco > 0)
                                <span style="width: 65px;
    margin-left: 80px;" class="badge badge-danger float-right mt-2">{{ $dism }}% OFF</span>
                                
                                @else
                                 <span style="width: 65px;
    margin-left: 80px;height:18px" class=" float-right mt-2"></span>
                                @endif
                            <div class="card-body p-0">
                                 
                              
                                <div class="card-image">
                                    
                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                                        
                                        <img style="" class="img-fit lazyload mx-auto" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                    </a>
                                    
                                    @php
                                            $qty = 0;
                                            if($product->variant_product){
                                                foreach ($product->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            }
                                            else{
                                                $qty = $product->current_stock;
                                            }
                                        @endphp
                                        @if ($qty > 0)
                                            
                                        @else
                                            <img style="width: 85%;height:50px;margin-bottom: 50px;margin-top:-100px" class="img-fit lazyload mx-auto" src="public/outstock.png" >
                                        @endif
                                </div>

                                <div class="p-md-3 p-2">
                                    <div class="price-box">
									<span class="product-price strong-600 text-success">{{ __($product->purchase_price) }}</span>
                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                        @endif
                                        
                                    </div>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($product->rating) }}
                                    </div>
                                    <h2 class="product-title p-0">
                                        <a href="{{ route('product', $product->slug) }}" class="text-truncate">{{ __($product->name) }}</a>
                                    </h2>

                                    @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                        <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                            {{ translate('Club Point') }}:
                                            <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<h6 class="mr-4">&nbsp Today's Deal</h6>

<section class="mb-2">
    <div class="container">
        <div class="px-2 p-md-2 bg-white shadow-sm">
            <div class="">
                
            </div>
            <div class="caorusel-box arrow-round gutters-5">
                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                    @foreach (filter_products(\App\Product::where('published', 1)->where('todays_deal', '1'))->limit(12)->get() as $key => $product)
                    <div class="caorusel-card">
                        <div class="product-card-2 card card-product shop-cards shop-tech">
                             @php
                                        
                                    $disco5 = $product->discount;
                                    $dism5 = str_replace(',00', '', number_format($disco5, 0, ',', '')); 
                                @endphp
                                @if ($disco5 > 0)
                                <span style="width: 65px;
    margin-left: 80px;" class="badge badge-danger float-right mt-2">{{ $dism5 }}% OFF</span>
                                
                                @else
                                 <span style="width: 65px;
    margin-left: 80px;height:18px" class=" float-right mt-2"></span>
                                @endif
                            <div class="card-body p-0">

                                <div class="card-image">
                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                                        <img class="img-fit lazyload mx-auto" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                    </a>
                                    @php
                                            $qty = 0;
                                            if($product->variant_product){
                                                foreach ($product->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            }
                                            else{
                                                $qty = $product->current_stock;
                                            }
                                        @endphp
                                        @if ($qty > 0)
                                            
                                        @else
                                            <img style="width: 85%;height:50px;margin-bottom: 50px;margin-top:-100px" class="img-fit lazyload mx-auto" src="public/outstock.png" >
                                        @endif
                                    
                                </div>

                                <div class="p-md-3 p-2">
                                    <div class="price-box">
									<span class="product-price strong-600 text-success">{{ __($product->purchase_price) }}</span>
                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                        @endif
                                        
                                    </div>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($product->rating) }}
                                    </div>
                                    <h2 class="product-title p-0">
                                        <a href="{{ route('product', $product->slug) }}" class="text-truncate">{{ __($product->name) }}</a>
                                    </h2>

                                    @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                        <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                            {{ translate('Club Point') }}:
                                            <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>







