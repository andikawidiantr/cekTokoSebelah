@extends('user-layout')

@section('isi')
<!--  Modal -->
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
    <section class="py-5">
        <!-- BILLING ADDRESS-->
        <h2 class="h5 text-uppercase mb-4">Billing details</h2>
        <div class="row">
            <div class="col-lg-8">
                <form action="/shop/checkout-produk" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="firstName">Nama</label>
                            <input disabled class="form-control form-control-lg" type="text"
                                placeholder="{{Auth::user()->name}}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="firstName">Email</label>
                            <input disabled class="form-control form-control-lg"  type="text"
                                placeholder="{{Auth::user()->email}}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="firstName">Address</label>
                            <input class="form-control form-control-lg" id="alamat_user" name="address" type="text"
                                placeholder="e.g: Jalan Sesama">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="country2">Province</label>
                            <select class="selectpicker country" id="provinsi_user" name="province" data-width="fit"
                                data-style="form-control form-control-lg" data-title="Select your country">
                                <option selected disabled>--Pilih Provinsi--</option>
                                @foreach($data_provinsi as $daftar_provinsi)
                                <option  data-provinsi="{{ $daftar_provinsi->province_id }}"
                                    value="{{$daftar_provinsi->name}}">{{$daftar_provinsi->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="email">City</label>
                            <select class="selectpicker country" id="kota_user" name="regency" data-width="fit"
                                data-style="form-control form-control-lg" data-title="Select your country">
                                <option selected disabled>--Pilih Kota--</option>
                                @foreach($data_kota as $daftar_kota)
                                <option  data-kota="{{ $daftar_kota->city_id }}" value="{{$daftar_kota->name}}">
                                    {{$daftar_kota->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="country2">Courier</label>
                            <select class="selectpicker country" id="pilihan_kurir" name="courier_id" data-width="fit"
                                data-style="form-control form-control-lg" data-title="Select your country">
                                <option selected disabled>--Pilih Kurir--</option>
                                @foreach($data_kurir as $daftar_kurir)
                                <option data-kurir="{{ $daftar_kurir->code }}" value="{{ $daftar_kurir->id }}">{{$daftar_kurir->courier}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <select class=" form-control" style="padding: 0px " name="shipping_cost" id="layanan" required>
                                <option value="" selected disabled>Pilih Layanan</option>
                            </select>
                        </div>

                        <div class="col-lg-12 form-group">
                            <button class="btn btn-dark" href="/shop/uploadbukti/{id}" type="submit">Place
                                order</button>
                        </div>
                    </div>
                
            </div>
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
                <div class="card border-0 rounded-0 p-lg-4 bg-light">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-4">Your order</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($data_cart as $cart)
                            <li class="d-flex align-items-center justify-content-between">
                                <strong class="small font-weight-bold">{{ $cart->produk->product_name }}</strong>
                                <span
                                    class="text-muted small">{{number_format(($cart->produk->price)*$cart->qty)}}</span>
                            </li>
                            @endforeach
                            <li class="border-bottom my-2"></li>
                            <li class="d-flex align-items-center justify-content-between"><strong
                                    class="text-uppercase small font-weight-bold">Total
                                    Harga</strong><span>Rp.{{ number_format($total) }}</span></li>
                            <li class="d-flex align-items-center justify-content-between"><strong
                                    class="text-uppercase small font-weight-bold" id="berat_total" data-berat="{{ $berat_total }}">Total
                                    Berat</strong><span>{{ number_format($berat_total) }} gr</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>
</div>

@endsection
@section('script')
<script>
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('#pilihan_kurir').on('change', function () {

        var kurir = $('#pilihan_kurir').find('option:selected').data("kurir");
        var kota = $('#kota_user').find('option:selected').data("kota");
        var berat = $('#berat_total').data('berat');
        var html_option = '';
        console.log(kurir);
        console.log(kota);
        console.log(berat);
        $.ajax({
            url: '/shop/cekongkir',
            type: 'post',
            data: {
                kurir: kurir,
                kota: kota,
                berat: berat
            },
            success: function (data) {
                $('select[name="shipping_cost"]').html(
                    '<option value="" selected>Tidak ada layanan</option>');

                // looping data result nya
                $.each(data, function (key, value) {
                    // looping data layanan misal jne reg, jne oke, jne yes
                    $.each(value.costs, function (key1, value1) {
                        // untuk looping cost nya masing masing
                        $.each(value1.cost, function (key2, value2) {
                            html_option += '<option value="' + value2
                                .value + '">' + value1.service + '-' +
                                value1.description + '- Rp.' + value2
                                .value + '</option>';
                            $('select[name="shipping_cost"]').html(
                                html_option);
                        });

                        loadSubOngkir();
                        loadtotals();
                    });
                });
            }
        });
    });
</script>
@endsection