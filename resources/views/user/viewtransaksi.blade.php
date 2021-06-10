@extends('user-layout')

@section('isi')
<div class="container">
    <!-- 
    CONTENT
    =============================================== -->
    <div class="row block none-padding-top">
        <div class="col-xs-12 col-md-12 col-lg-12 get-height">
            <div class="sdw-block">
                <div class="wrap bg-white">

                    <!-- Authirize form -->
                    <div class="row auth-form">
                        <!-- Header & nav -->
                        <div class="col-md-12">

                            <!-- Header -->
                           
                            <!-- PROFILE HEADER -->
                            <div class="profile-header">
                             

                                <!-- Shopping Cart table -->
                                <div class="table-responsive col-md-12 col-lg-12 ">
                                    <h1 align="center" style="margin-top: 90px">Daftar Transaksi Produk</h1>
                    <br>
                                    <table class="table product-table">
                                        <!-- Table head -->
                                        <thead>
                            
                                            <tr>
                                                <th class="text-center">
                                                    <strong>Time Create</strong>
                                                </th>

                                                <th class="text-center">
                                                <strong>Status</strong>
                                                </th>
                                
                                                <th class=" text-center">
                                                <strong>Shipping cost</strong>
                                                </th>

                                                <th class="text-center" >
                                                    <strong style="margin-right: -40px">Product</strong>
                                                </th>
                                
                                                <th class=" text-center">
                                                <strong>Total Product Price</strong>
                                                </th>
                                    
                                                <th class=" text-center">
                                                <strong>Detail</strong>
                                                </th> 
                                
                                            </tr>
                            
                                        </thead>
                                        <!-- Table head -->
                            
                                        <!-- Table body -->
                                        <tbody>
                            
                                            <!-- First row -->
                                            @foreach ($data_transaksi as $transaksi)

                                            <tr>
                                                <td>
                                                    <h5 class=" text-center"> 
                                                        <strong class=" text-uppercase">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y')}}</strong>
                                                    </h5>
                                                </td>
                                                
                                
                                                <td>
                                                    <h5 class="text-center">
                                                        @if ($transaksi->status=='success')
                                                        <strong class=" text-uppercase text-green">{{ $transaksi->status }}</strong>
                                                        @endif
                                                        @if ($transaksi->status=='expired')
                                                        <strong class=" text-uppercase text-red">{{ $transaksi->status }}</strong>
                                                        @endif
                                                        @if ($transaksi->status=='canceled')
                                                        <strong class=" text-uppercase text-grey-darkness">{{ $transaksi->status }}</strong>
                                                        @endif
                                                        @if ($transaksi->status=='delivered')
                                                        <strong class=" text-uppercase text-blue">{{ $transaksi->status }}</strong>
                                                        @endif
                                                        @if ($transaksi->status=='verified')
                                                        <strong class=" text-uppercase text-green">{{ $transaksi->status }}</strong>
                                                        @endif
                                                        @if ($transaksi->status=='unverified')
                                                        <strong class=" text-uppercase text-yellow">{{ $transaksi->status }}</strong>
                                                        @endif
                                                    </h5>
                                                </td>

                                                <td>
                                                    <h5 class=" text-center">
                                                        <strong class=" text-uppercase">Rp. {{ number_format($transaksi->shipping_cost) }}</strong>
                                                    </h5>
                                                </td>
                                                
                                                <td>
                                                    <h5 class="text-center">
                                                        <strong class=" text-uppercase text-center">
                                                            @foreach ($transaksi->produk as $transaksi_produk)
                                                            <ol>
                                                                <a href="/produk/{{ $transaksi_produk->id }}/tampil">
                                                                    {{ $transaksi_produk->product_name}}
                                                                </a>
                                                            </ol>    
                                                            @endforeach
                                                        </strong>
                                                    </h5>
                                                </td>
                                                
                                                <td>
                                                    <h5 class=" text-center">
                                                        <strong class=" text-uppercase ">Rp. {{ number_format($transaksi->sub_total) }}</strong>
                                                    </h5>
                                                </td>

                                                <td class="text-center">
                                                    <!-- info btn -->
                                                    <a href="/shop/uploadbukti/{{$transaksi->id}}" class=" btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    
                                                </td>
                                                

                                               
                                            </tr>

                                            @endforeach
                                        </tbody>
                                        <!-- Table body -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CONTENT -->
</div>
<br><br>
@endsection