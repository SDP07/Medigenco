@extends('frontend.layouts.app')

@section('content')
<br>
<br>
<div class="container">
            <div class="subtitle h6">
                <div class="d-inline-block">
                    My Wishlist<br>
                    <!--<p class="small text-mute">3 Items</p>-->
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush mb-4">
                        @foreach ($wishlists as $key => $wishlist)
                                @if ($wishlist->product != null)
                        
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button onclick="removeFromWishlist({{ $wishlist->id }})" class="btn btn-sm btn-link p-0 float-right"><i style="color:red" class="material-icons">remove_circle</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img src="{{ my_asset($wishlist->product->thumbnail_img) }}" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">{{ $wishlist->product->name }} </a>
                                    <h5 class="text-success font-weight-normal mb-0">{{ home_discounted_base_price($wishlist->product->id) }}</h5>
                                    @if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                        <del class="">{{ home_base_price($wishlist->product->id) }}</del>
                                    @endif
                                </div>
                                <div class="col-auto align-self-center">
                                    <button onclick="showAddToCartModal({{ $wishlist->product->id }})" type="button" class="btn btn-block btn-base-1 btn-circle btn-icon-left" >
                                        <i style="font-size: 25px;" class="la la-shopping-cart mr-2"></i>{{ translate('Cart')}}
                                    </button>
                                </div>
                            </div>
                        </li>
                        
                       @endif
                            @endforeach 
                        
                    </ul>
                </div>
            </div>
            
             <div class="pagination-wrapper py-4" hidden>
                            <ul class="pagination justify-content-end">
                                {{ $wishlists->links() }}
                            </ul>
                        </div>

            



        </div>

    

    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                showFrontendAlert('success', 'Item has been renoved from wishlist');
                window.location.reload();
            })
        }
    </script>
@endsection
