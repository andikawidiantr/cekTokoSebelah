@extends('user-layout')

@section('isi')

<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Shop</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <!-- SHOP SIDEBAR-->
                <div class="col-lg-3 order-2 order-lg-1">
                    <h5 class="text-uppercase mb-4">Categories</h5>
                    <div class="py-2 px-4 bg-dark text-white mb-3"><strong
                            class="small text-uppercase font-weight-bold">Category &amp; List</strong></div>
                    <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">

                        @foreach ($data_kategori as $listkategori)
                        <li><a href="/shop/kategori/{{ $listkategori->id }}" class="reset-anchor">
                                <h6>{{ $listkategori->category_name }}</h6>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- SHOP LISTING-->
                <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                    <!-- <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-small text-muted mb-0">Showing 1–12 of 53 results</p>
                  </div>
                </div> -->
                    <div class="row">
                        <!-- PRODUCT-->
                        <!-- PRODUCT-->
                        @foreach ($filterkategori as $produk)
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="mb-3 position-relative">

                                    <!--  -->
                                    @foreach ($produk->RelasiImage as $productImage)
                                    <a class="image featured"><img width="100px"
                                            src="{{asset('product_image/'.$productImage->image_name)}}" alt="" /></a>
                                    @endforeach
                                    <div class="product-overlay">

                                        <form action="/shop/cart/store" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $produk->id }}" name="id_produk">
                                            <button class="list-inline-item m-0 p-0"><a
                                                    class="btn btn-sm btn-outline-dark"><i
                                                        class="	fa fa-shopping-cart"></i></a></button>

                                            <!-- <button class="fa fa-shopping-cart" style="width: 300px; padding-right: 41px" type="submit"></button> -->
                                            <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="/shop/detail/{{$produk->id}}"><i class="	fa fa-shopping-cart"></i></a></li> -->
                                        </form>
                                        <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="/shop/detail/{{$produk->id}}"><i class="	fa fa-eye"></i></a></li> -->
                                        <div class="col-sm-0 pl-sm-0"><a
                                                class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0"
                                                href="/shop/detail/{{$produk->id}}">See Product</a></div>
                                        <form action="/shop/store/buynow" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $produk->id }}" name="id_produk">
                                            <button class="list-inline-item m-0 p-0"><a
                                                    class="btn btn-sm btn-outline-dark"><i
                                                        class="fas fa-dollar-sign"></i></a></button>
                                            <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="/shop/detail/{{$produk->id}}"><i class="	fa fa-eye"></i></a></li>
                              <button class="fa fa-shopping-cart" style="width: 300px; padding-right: 41px" type="submit"></button> -->
                                            <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="/shop/detail/{{$produk->id}}"><i class="	fa fa-shopping-cart"></i></a></li> -->
                                        </form>
                                        <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="/shop/cart/store/{{$produk->id}}"><i class="fa fa-shopping-cart"></i></a></li>  -->

                                        <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="/shop/buynow" ><i class="fas fa-dollar-sign"></i></a></li> -->

                                    </div>
                                </div>
                                <td class="text-center">
                                    <h6>{{$produk->product_name}}</h6>
                                </td>
                                @if ($produk->reviewproduk->avg('rate'))

                                @for ($i = 0; $i < 5; $i++) @if (floor($produk->reviewproduk->avg('rate')) - $i >= 1)
                                    {{--Full Start--}}
                                    <i class="fas fa-star text-warning"> </i>
                                    @elseif ($produk->reviewproduk->avg('rate') - $i > 0)
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
                                        <p class="small text-muted">Rp. {{number_format($produk->price)}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

