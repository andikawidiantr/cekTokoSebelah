@extends('user-layout')

@section('isi')
<!--  Modal -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <!-- PRODUCT SLIDER-->
                <div class="row m-sm-0">
                    <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                        <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                            @foreach ($product->RelasiImage as $productImage)
                            <!-- <a class="image featured"><img width="100px" src="{{asset('product_image/'.$productImage->image_name)}}" alt="" /></a> -->
                            <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100"
                                    src="{{asset('product_image/'.$productImage->image_name)}}" alt="..."></div>
                            @endforeach
                            <!-- <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-1.jpg" alt="..."></div>
                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-2.jpg" alt="..."></div>
                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-3.jpg" alt="..."></div> -->
                            <!-- <div class="owl-thumb-item flex-fill mb-2"><img class="w-100" src="img/product-detail-4.jpg" alt="..."></div> -->
                        </div>
                    </div>
                    <div class="col-sm-10 order-1 order-sm-2">
                        <div class="owl-carousel product-slider" data-slider-id="1">
                            @foreach ($product->RelasiImage as $productImage)
                            <!-- <a class="image featured"><img width="100px" src="{{asset('product_image/'.$productImage->image_name)}}" alt="" /></a> -->
                            <!-- <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="{{asset('product_image/'.$productImage->image_name)}}" alt="..."></div> -->
                            <a class="d-block" href="img/product-detail-1.jpg" data-lightbox="product"
                                title="Product item 1">
                                <img class="img-fluid" src="{{asset('product_image/'.$productImage->image_name)}}"
                                    alt="..."></a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">
                @if ($product->reviewproduk->avg('rate'))

                @for ($i = 0; $i < 5; $i++) @if (floor($product->reviewproduk->avg('rate')) - $i >= 1)
                    {{--Full Start--}}
                    <i class="fas fa-star text-warning"> </i>
                    @elseif ($product->reviewproduk->avg('rate') - $i > 0)
                    {{--Half Start--}}
                    <i class="fas fa-star-half-alt text-warning"> </i>
                    @else
                    {{--Empty Start--}}
                    <i class="far fa-star text-warning"> </i>
                    @endif
                    @endfor

                    @else
                    @for ($i = 0; $i < 5; $i++) <i class="far fa-star"></i>
                        @endfor

                        @endif
                        <!-- <ul class="list-inline mb-2">
                            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        </ul> -->
                        <h1>{{$product->product_name}}</h1>
                        <p class="text-muted lead">Rp. {{number_format($product->price)}}</p>
                        <p class="text-small mb-4">{{$product->description}}</p>
                        <div class="row align-items-stretch mb-4">
                            <div class="col-sm-12 pr-sm-12">
                                <form action="/shop/cart/store" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="id_produk">
                                    <!-- <button class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" ><i class="	fa fa-shopping-cart"></i></a></button> -->
                                    <div class="col-sm-12 pl-sm-0"><button
                                            class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-12">Add
                                            to cart</button></div>
                                    <!-- <button class="fa fa-shopping-cart" style="width: 300px; padding-right: 41px" type="submit"></button> -->
                                </form>
                            </div>


                        </div>
            </div>
        </div>
        <!-- DETAILS TABS-->
        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                    role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                    aria-controls="reviews" aria-selected="false">Reviews</a></li>
        </ul>
        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="p-4 p-lg-5 bg-white">
                    <h6 class="text-uppercase">Product description </h6>
                    <p class="text-muted text-small mb-0">{{$product->description}}</p>
                </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="p-4 p-lg-5 bg-white">
                    <div class="row">
                        <div class="col-lg-8">
                            @foreach ($product->reviewproduk as $review)


                            <h6 class="mb-0 text-uppercase">{{$review->user->name}}</h6>
                            <span class="media-info">{{ date("d F Y", strtotime($review->created_at)) }}</span><br>
                        



                                    <p class="small text-muted mb-0 text-uppercase">{{$review->content}}</p> <br>
                                    <div class="row">
                                     <div class="col-md-2">  </div> 
                                    
                                    @foreach ($review->response as $respon_admin)
                                                <div class="media">
                                                    <div class="media-left">
                                                        
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="row">
                                                    <h6 class="mb-0 text-uppercase">{{ $respon_admin->admin->name }}</h6><div class="mb-0">(admin)</div></div>
                                                        <span class="media-info">{{ date("d F Y", strtotime($respon_admin->created_at)) }}</span>

                                                        <p class="small text-muted mb-0 text-uppercase"> {{ $respon_admin->content }}</p> <br>
                                                       

                                                      
                                                    </div>
                                                </div>
                                                    
                                                @endforeach
                                            </div>
                                    @endforeach

</div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- RELATED PRODUCTS-->

    </div>
</section>

@endsection
