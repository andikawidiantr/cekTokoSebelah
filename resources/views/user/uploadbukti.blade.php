@extends('user-layout')

@section('isi')
<!--  Modal -->

<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Checkout</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="cart.html">Cart</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-12">
                    <h3 class="h3 text-uppercase mb-0">Upload Bukti Pembayaran</h3>
                </div>

                <div class="list-body">
                    <div class="profile-main text-center"><br><br><br>
                        @if(!is_null($data_transaksi->proof_of_payment)&&!( $data_transaksi->status == 'success')&&!(
                        $data_transaksi->status == 'expired'))
                        <h2 class="text-uppercase text-blue"
                            style="font-weight: bolder; padding-bottom: 70px; font-size: 80px">
                            MEnunggu Verifikasi
                        </h2>
                        @else

                        @if ($data_transaksi->status == 'canceled' || $data_transaksi->status == 'expired' ||
                        $data_transaksi->status == 'verified' || $data_transaksi->status == 'delivered' ||
                        $data_transaksi->status == 'success' )
                        @if ($data_transaksi->status == 'verified' || $data_transaksi->status == 'delivered' ||
                        $data_transaksi->status == 'success' )
                        <h1 class="text-uppercase text-blue"
                            style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                            Pembayaran Berhasil
                            @if ($data_transaksi->status == 'success')
                            <!-- Form -->
                    </div>
                    <div class="row">
                        <div class="col-sm-1 center"></div>
                        <div class="col-sm-10 center">

                            <!-- Header -->
                            <br>
                            <h3 class="header text-center">Add Product Feedback</h3>
                            <div></div>

                            <table class="table product-table">
                                <!-- Table head -->
                                <thead>

                                    <tr>
                                        <th class="text-center">
                                            <strong>Product</strong>
                                        </th>

                                        <!-- <th class="text-center">
                                            <strong>Discount</strong>
                                        </th> -->
                                        <!-- style="margin-right: -40px" -->
                                        <th class="text-center">
                                            <strong>PRICE</strong>
                                        </th>

                                        <th class=" text-center">
                                            <strong>QTY</strong>
                                        </th>

                                        <th class=" text-center">
                                            <strong>ADD REVIEW</strong>
                                        </th>

                                    </tr>

                                </thead>
                                <!-- Table head -->

                                <!-- Table body -->
                                <tbody>
                                    <tr>
                                        @foreach ($data_transaksi->detail_transaksi as $data)
                                            <td class="text-center">{{$data->relasiproduk->product_name}}</td>
                                          
                                            <td class="text-center">Rp. {{number_format($data->relasiproduk->price)}}</td>
                                            {{-- TOMBOL SHOW --}}
                                         
                                            <td class="text-center">{{$data->qty }}</td>   
                                            <td class="text-center"> 
                                                <a href="/shop/addreview/{{$data->relasiproduk->id}}" type="button" class="btn btn-info btn-xs">
                                                    <i class="fas fa-plus"> Add Review</i> <!--class="fa fa-exclamation-circle" tanda seru -->
                                                </a>
                                            </td>  
                                        @endforeach
                                        
                                    </tr>
                                            
                                </tbody>
                                <!-- Table body -->
                               
                            </table><br>
                         

                            <a type="submit" class="btn btn-primary btn-material" href="/transaksi">
                                <span class="body" href="/transaksi">Back</span>
                                <i class="icon icofont icofont-check-circled"></i>
                            </a>
                            <br><br>
                            <form class="form-horizontal" method="POST" action="/produk/review" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group text-center">

                                    <div class="col-sm-12">

                                        <select name="product_id" class="form-control" id="exampleFormControlSelect1"
                                            style="padding: 0px ">
                                            <option selected disabled>Chose Product</option>
                                            @foreach ($data_transaksi->produk as $produk)

                                            <option value="{{ $produk->id }}">{{ $produk->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12">

                                        <select name="rate" class="form-control" id="exampleFormControlSelect1"
                                            style="padding: 0px ">
                                            <option selected disabled>Rating</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea name="content" class="form-control" id="inputcomment" cols="30"
                                            rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="form-group " align="center">

                                    <a type="submit" class="btn btn-primary btn-material" href="/transaksi">
                                        <span class="body" href="/transaksi">Back</span>
                                        <i class="icon icofont icofont-check-circled"></i>
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-material" href="/shop">
                                        <span class="body" href="/shop">Kirim Ulasan</span>
                                        <i class="icon icofont icofont-check-circled"></i>
                                    </button>
                                    <!-- <a href="/transaksi">dsadsda</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    </h1>

                    @else

                    <h1 class="text-uppercase text-blue"
                        style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                        Transaksi gagal
                    </h1>
                    @endif
                    @else

                    <h1 class="text-uppercase text-blue text-center"
                        style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                        {{ $deadline }}
                    </h1>
                    <div class="col-lg-12">
                        <a class="breadcrumb-item active">Foto/Screenshot Bukti Transfer</a>
                    </div>

                    <form action="/shop/uploadpembayaran/{{$data_transaksi->id}}" method="POST"
                        enctype="multipart/form-data">
                        <div allign="center">
                            <div class="form-group ">
                                <input type="file" class="form-control" placeholder="Enter your promocode"
                                    name="foto_pembayaran[]" required accept="image/*">
                            </div>
                        </div>
                        <div class="row">
                            <span class="btn-panel col-md-4">
                                @csrf
                                <button type="submit" class="sdw-wrap btn-primary">
                                    <a class="sdw-hover btn btn btn-material btn-primary">

                                        <span class="body">Submit</span></a>

                                </button>
                            </span>
                    </form>

                    <span class="btn-panel text-center">
                        <form action="/shop/cancel/{{$data_transaksi->id}}" method="POST">
                            @csrf
                            <button class="sdw-wrap btn-danger">
                                <a class="sdw-hover btn btn btn-material btn-danger">
                                    {{-- <i class="icon icofont icofont-close-circled"></i> --}}
                                    <span class="body"
                                        onclick="return confirm('Anda yakin ingin membatalkan pesanan?')">canceled</span></a>

                            </button>
                        </form>
                        @endif
                </div>
            </div>


            @endif



        </div>
</div>
</div>
</section>

</div>

<br><br>
@endsection