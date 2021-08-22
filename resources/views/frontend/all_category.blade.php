@extends('frontend.layouts.app')

@section('content')
<br>
<br>

<div class="all-category-wrap py-4 gry-bg">
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="bg-white all-category-menu">
                        <ul class="d-flex flex-wrap no-scrollbar text-center">
                            @if(count($categories) > 52)
                                @for ($i = 0; $i < 51; $i++)
                                    <li style="width: 50%;height: 100px;" >
                                        <a href="#{{ $i }}" class="row no-gutters align-items-center">
                                            <div class="col-md-4">
                                                <img style="height: 60px;" loading="lazy"  class="" src="{{ my_asset($categories[$i]->icon) }}">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="cat-name">{{ $categories[$i]->name }}</div>
                                            </div>
                                        </a>
                                    </li>
                                @endfor
                                <li style="width: 50%;height: 100px;" >
                                    <a href="#more" class="row no-gutters align-items-center">
                                        <div class="col-md-3">
                                            <i class="fa fa-ellipsis-h cat-icon"></i>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="cat-name">{{ translate('More Categories')}}</div>
                                        </div>
                                    </a>
                                </li>
                            @else
                                @foreach ($categories as $key => $category)
                                    <li style="width: 50%;height: 100px;" >
                                        <a onclick="location.href = '{{ route('products.category', $category->slug) }}';" href="{{ route('products.category', $category->slug) }}" class="row no-gutters align-items-center">
                                            <div class="col-md-3">
                                                <img style="height: 60px;" loading="lazy"  class="" src="{{ my_asset($category->icon) }}">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="cat-name">{{  __($category->name) }}</div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="mt-4" hidden>
        <div class="container">
            @foreach ($categories as $key => $category)
                @if(count($categories)>12 && $key == 11)
                <div class="mb-3 bg-white">
                    <div class="sub-category-menu active" id="more">
                        <h3 class="category-name border-bottom pb-2"><a href="{{ route('products.category', $category->slug) }}">{{  __($category->name) }}</a></h3>
                        <div class="row">
                            @foreach ($category->subcategories as $key => $subcategory)
                            <div class="col-lg-4 col-6">
                                <h6 class="mb-3"><a style="color:limegreen" href="{{ route('products.subcategory', $subcategory->slug) }}">{{  __($subcategory->name) }}</a></h6>
                                
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                <div class="mb-3 bg-white">
                    <div class="sub-category-menu @php if($key < 12) echo 'active'; @endphp" id="{{ $key }}">
                        <h3 class="category-name border-bottom pb-2"><a href="{{ route('products.category', $category->slug) }}" >{{  __($category->name) }}</a></h3>
                        <div class="row">
                            @foreach ($category->subcategories as $key => $subcategory)
                            <div class="col-lg-4 col-6">
                                <h6 class="mb-3"><a style="color:limegreen" href="{{ route('products.subcategory', $subcategory->slug) }}">{{  __($subcategory->name) }}</a></h6>
                                
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection
