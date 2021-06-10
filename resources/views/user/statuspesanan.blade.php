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
        
        <div class="text-center"><h1>Terima Kasih</h1> <br><h3>Harap Ditunggu Pesanan </h3> </div> <bold>
<br><br>
        <div class="text-right ">
                    
                        
                        <a href="/shop" style="color: black;" class="fas fa-arrow-left ">  Kembali ke halaman utama <div class="fas fa-arrow-left "> </div></a> 	
          
                </div>
            <!-- <div class="col-xs-12">
                @if ($data_transaksi->status == 'canceled' || $data_transaksi->status == 'expired' ||
                $data_transaksi->status == 'verified' || $data_transaksi->status == 'unverified' ||
                $data_transaksi->status == 'delivered' || $data_transaksi->status == 'success' )
                    @if ($data_transaksi->status == 'verified' || $data_transaksi->status == 'unverified' ||
                $data_transaksi->status == 'delivered' || $data_transaksi->status == 'success' )
                         @if ($data_transaksi->status == 'verified' || $data_transaksi->status == 'unverified' )
                <ul class="steps row block" style="margin-left: 205px">
                    <li class="hidden-xs col-sm-4 col-md-4 col-lg-3">
                        <span class="text-blue">
                            Pesanan
                            <br>
                            Diproses
                        </span>

                        <span class="dir-icon">
                            <i class="	fas fa-angle-double-right"></i>
                        </span>
                    </li>

                    <li class="hidden-xs col-sm-4 col-md-4 col-lg-3">
                        <span>
                            Sedang
                            <br>
                            Dikirim
                        </span>

                        <span class="dir-icon hidden-sm hidden-md">
                            <i class="icofont icofont-stylish-right"></i>
                        </span>
                    </li>

                    <li class="hidden-xs col-lg-3 hidden-sm hidden-md">
                        <span>
                            Sampai
                            <br>
                            Tujuan
                        </span>
                    </li>
                </ul>
                @endif
                @if ($data_transaksi->status == 'delivered')
                <ul class="steps row block" style="margin-left: 205px">
                    <li class="hidden-xs col-sm-4 col-md-4 col-lg-3">
                        <span class="text-blue">
                            Pesanan
                            <br>
                            Diproses
                        </span>

                        <span class="dir-icon">
                            <i class="icofont icofont-stylish-right"></i>
                        </span>
                    </li>

                    <li class="hidden-xs col-sm-4 col-md-4 col-lg-3">
                        <span class="text-blue">
                            Sedang
                            <br>
                            Dikirim
                        </span>

                        <span class="dir-icon hidden-sm hidden-md">
                            <i class="icofont icofont-stylish-right text-yellow"></i>
                        </span>
                    </li>

                    <li class="hidden-xs col-lg-3 hidden-sm hidden-md">
                        <span>
                            Sampai
                            <br>
                            Tujuan
                        </span>
                    </li>
                </ul>
                @endif
                @if ($data_transaksi->status == 'success')
                <ul class="steps row block" style="margin-left: 205px">
                    <li class="hidden-xs col-sm-4 col-md-4 col-lg-3">
                        <span class="text-blue">
                            Pesanan
                            <br>
                            Diproses
                        </span>

                        <span class="dir-icon">
                            <i class="icofont icofont-stylish-right"></i>
                        </span>
                    </li>

                    <li class="active hidden-xs col-sm-4 col-md-4 col-lg-3">
                        <span class="text-blue">
                            Sedang
                            <br>
                            Dikirim
                        </span>

                        <span class="dir-icon hidden-sm hidden-md">
                            <i class="icofont icofont-stylish-right"></i>
                        </span>
                    </li>

                    <li class="hidden-xs col-lg-3 hidden-sm hidden-md">
                        <span class="text-green">
                            Sampai
                            <br>
                            Tujuan
                        </span>
                    </li>
                </ul>

                @endif
                @else
                <h1 class="text-uppercase text-blue"
                    style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                    Proses transaksi gagal
                </h1>
                @endif
                @else
                <h1 class="text-uppercase text-blue"
                    style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                    {{ $deadline }}
                </h1>
                @endif
           
                <div class="form-group ">
                    <button type="button" class="sdw-hover btn btn-material btn-yellow btn-lg ripple-cont">
                        {{-- <i class="mdi mdi-file-restore btn-icon-prepend "></i>      --}}
                        <a href="/shop" style="color: black;">Kembali ke halaman utama</a>
                    </button>
                </div>


                @if ($data_transaksi->status == 'success')
                
               

                @endif -->

              
            </div>
        </div>
    </section>

</div>

<br><br>
@endsection