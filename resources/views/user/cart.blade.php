@extends('user-layout')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('isi')
        <!--  Modal -->
       
        <div class="container">
            <!-- HERO SECTION-->
            <section class="py-5 bg-light">
                <div class="container">
                    <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                        <div class="col-lg-6">
                            <h1 class="h2 text-uppercase mb-0">Cart</h1>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-5">
                <h2 class="h5 text-uppercase mb-4 text-center">Shopping cart</h2>
                <div class="row">
                    <div class="col-lg-12 mb-4 mb-lg-0">
                        <!-- CART TABLE-->
                        <div class="table-responsive mb-4">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0" scope="col"> <strong
                                                class="text-small text-uppercase text-center">Product</strong></th>
                                        <th class="border-0" scope="col"> <strong
                                                class="text-small text-uppercase text-center">Price</strong></th>
                                        <th class="border-0" scope="col"> <strong
                                                class="text-small text-uppercase text-center">Quantity</strong></th>
                                        <th class="border-0" scope="col"> <strong
                                                class="text-small text-uppercase text-center">Total</strong></th>
                                        <th class="border-0" scope="col"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                      @foreach ($data_cart as $cart)
                      @php
                        $image = $cart->produk->getfirstimage();
                      @endphp
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.html"><img src="{{asset('product_image/'.$image->image_name)}}" alt="..." width="70"/></a>
                          <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.html">{{$cart->produk->product_name}}</a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p id="price{{$cart->id}}"data-price="{{$cart->produk->price}}"class="mb-0 small">Rp. {{number_format($cart->produk->price)}}</p>
                      </td>
                      <td class="align-middle border-0">
                        <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
                          <div class="quantity">
                            <button id="dec{{$cart->id}}"class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                            <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" value="1"/>
                            <button id="inc{{$cart->id}}"class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle border-0">
                        <p id="total{{$cart->id}}"class="mb-0 small">Rp. {{number_format($cart->produk->price)}}</p>
                      </td>
                      <td class="align-middle border-0"><a class="reset-anchor" href="/shop/cart/{{$cart->id}}/deletecart"><i class="fas fa-trash-alt small text-muted"></i></a></td>
                    </tr>
                      @endforeach
                   
                        </tbody>
                        </table>
                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm"
                                    href="/shop"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Continue
                                    shopping</a></div>
                            <div class="col-md-6 text-md-right"><a class="btn btn-outline-dark btn-sm"
                                    href="/shop/checkout">Procceed to checkout<i
                                        class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- ORDER TOTAL-->
               
        </div>
        </section>
    </div>
@endsection
@section('script')
<script>
    function formatRupiah(angka, prefix){
			var number_string = angka.toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
        $('.inc-btn').click(function(){
            var qty=parseInt($(this).siblings('input').val());
            qty++;
            var cart_id=$(this).attr('id').substring(3);
            var harga=parseInt($(`#price${cart_id}`).attr('data-price'));
            // console.log(qty);
            // console.log(cart_id);
            $(`#total${cart_id}`).html("Rp. " + formatRupiah(harga*qty));
            saveCart(qty,cart_id);
        });
        $('.dec-btn').click(function(){
            var qty=parseInt($(this).siblings('input').val());
            qty--;
            var cart_id=$(this).attr('id').substring(3);
            var harga=parseInt($(`#price${cart_id}`).attr('data-price'));
            // console.log(qty);
            // console.log(cart_id);
            $(`#total${cart_id}`).html("Rp. " + formatRupiah(harga*qty));
            saveCart(qty,cart_id);
        });
        function saveCart(qty,id){
            let _token = $('meta[name="csrf-token"]').attr('content');
            // console.log(qty);
            // console.log(id);
            // console.log(_token);
            $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': _token
				}
			});
			$.ajax({
				type: "POST",
				url: "/shop/cart/update",
				data: {
                    'cart_id': id,
                    'qty':qty,
                },
				success: function(data){
                    console.log("astungkara");
				},
				dataType: "JSON"
			});
        }
    </script>
@endsection