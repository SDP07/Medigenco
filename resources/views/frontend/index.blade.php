
@extends('frontend.layouts.app')

@section('content')
   
<title>home</title>	
<br>
<br>
<br>
            <div class="row no-gutters position-relative">
                <div class="col-lg-3 position-static order-2 order-lg-0">
                    <div class="category-sidebar" style="margin-top: -35px;">
                        
                        <ul class="categories no-scrollbar">
                            
                            {{-- @foreach (\App\Category::orderBy('orderby', 'ASC')->get() as $key => $category)
                                @php
                                    $brands = array();
                                @endphp
                                <li style="margin: 0 0px;height:125px" class="category-nav-element" data-id="{{ $category->id }}">
                                    <a style="padding: 1px 10px;" href="{{ route('products.category', $category->id) }}" class="text-truncate">
                                        <img style="height: 80px;width: 100%;" class=" lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($category->icon) }}" width="60" alt="{{ __($category->name) }}">
                                        <span class="cat-name">{{ __($category->name) }}</span>
                                    </a>
                                    @if(count($category->subcategories)>0)
                                        <div class="sub-cat-menu c-scrollbar">
                                            <div class="c-preloader">
                                                <i class="fa fa-spin fa-spinner"></i>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach --}}
							<li class="d-lg-none">
                                {{-- <a href="{{ route('categories.all') }}" class="text-truncate">
                                    <img class="cat-image lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset('frontend/images/icons/list.png') }}" width="30" alt="{{ translate('All Category') }}">
                                    <span class="cat-name">{{ translate('All') }} <br> {{ translate('Categories') }}</span>
                                </a> --}}
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- @php
                    $num_todays_deal = count(filter_products(\App\Product::where('published', 1)->where('todays_deal', 1 ))->get());
                    $featured_categories = \App\Category::where('featured', 1)->get();
                @endphp --}}

                

                

            </div>
      

    

    <div class="mb-1 mt-1" style="background-color: white;">
        <!-- page content here -->
                <div style="height: 155px;
    margin-top: -5px;
    padding-top: 5px;
    background-color: white;padding-bottom: 5px;" data-effect="flip" class="swiper2-container swiper-init demo-swiper demo-swiper-cube">
                    <div class="swiper-wrapper">
					{{-- @foreach (\App\Banner::where('position', 1)->where('published', 1)->get() as $key => $banner)
                        <div style="background-image:url({{ my_asset($banner->photo) }});height: 125px;" class="swiper-slide"></div>
                        @endforeach --}}
                    </div>
                </div>
                <!-- page content ends -->
    </div>
	
	<h6 class="mr-4">&nbsp {{ translate('Featured Products')}}</h6>
	

    <div id="section_featured">

    </div>

   <br>
   
   
    <div class="" >


                
                        <img src="public/img/threesteps.png" style="width: 100%">
                  
             

            </div>
   
   <br>
   <br>
   <br>

 

    


    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                slickInit();
            });

           
        });
    </script>
	   
    <script>
        $(window).on('load', function() {
            /* swiper slider carousel */
            var swiper = new Swiper('.small-slide', {
                slidesPerView: 'auto',
                spaceBetween: 0,
            });

            var swiper = new Swiper('.news-slide', {
                slidesPerView: 5,
                spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination',
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 0,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 0,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                    },
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                    }
                }
            });

            /* notification view and hide 
            setTimeout(function() {
                $('.notification').addClass('active');
                setTimeout(function() {
                    $('.notification').removeClass('active');
                }, 3500);
            }, 500);
            $('.closenotification').on('click', function() {
                $(this).closest('.notification').removeClass('active')
            });*/ 
        });

    </script>
    <script>
        var swiper2 = new Swiper('.swiper2-container', {
            effect: 'slide',
            grabCursor: true,
            autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
            pagination: {
                el: '.swiper2-pagination',
            },
            navigation: {
                nextEl: '.swiper2-button-next',
                prevEl: '.swiper2-button-prev',
            },
        });

    </script>
@endsection
