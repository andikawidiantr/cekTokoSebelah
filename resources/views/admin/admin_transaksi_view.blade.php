@extends('main')

@section('isi')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Detail Produk -->
        <h1 class="h2 mb-2 text-gray-800 text-center"><b> Detail Transaksi</b></h1> <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('sukses'))
            <div class="alert alert-success" role="alert">
                {{ session('sukses') }}
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">

                    @if (is_null($data_transaksi->proof_of_payment))


                    @else
                    <!-- Foto Bukti Pembayaran Produk -->
                    <h2 class="text-center">Bukti pembayaran produk</h2>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">

                            <!-- Image & Caption -->
                            <div class="body">

                                <div class="table">
                                    <div class="row text-center owl-carousel">

                                        <div class="thumbnail">
                                            <img class="img-fluid-left img-thumbnail"
                                                src="{{asset('bukti_bayar/'.$data_transaksi->proof_of_payment)}}"
                                                alt="light" style="height:200px;">

                                        </div>

                                    </div>
                                </div>



                            </div>



                        </div>
                    </div>
                    @endif

                    <!-- Data -->
                    <div class="form-group">
                        <table class="table table-striped table-bordered " align="center">
                            <tbody>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($data_transaksi->status == 'delivered' || $data_transaksi->status
                                        =='unverified')
                                        @if ($data_transaksi->status == 'delivered')
                                        <form action="/admin/transaksi/{{ $data_transaksi->id }}/status" method="POST">
                                            @csrf
                                            <select class="form-control " name="pilih_status" id="pilih_status">
                                                <option selected value="{{ $data_transaksi->status}}">
                                                    {{ $data_transaksi->status}}</option>
                                                <option value="success">success</option>
                                            </select>

                                            @else
                                            <form action="/admin/transaksi/{{ $data_transaksi->id }}/verifikasi"
                                                method="POST">
                                                @csrf
                                                <select class="form-control " name="pilih_status" id="pilih_status">
                                                    <option selected value="{{ $data_transaksi->status}}">
                                                        {{ $data_transaksi->status}}</option>
                                                    <option value="verified">verified</option>
                                                    <option value="canceled">canceled</option>
                                                </select>

                                                @endif

                                                @else

                                                {{ $data_transaksi->status}}
                                                @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Nama Pengguna</th>
                                    <td>{{ $data_transaksi->user->name}}</td>
                                </tr>

                                <tr>
                                    <th>Total Harga</th>
                                    <td>Rp.{{ number_format($data_transaksi->total) }}</td>
                                </tr>

                                <tr>
                                    <th>Deadline</th>
                                    <td>{{ date("d F Y", strtotime($data_transaksi->timeout)) }}</td>

                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $data_transaksi->address}}</td>

                                </tr>
                                <tr>
                                    <th>Kota</th>
                                    <td>{{ $data_transaksi->regency}}</td>

                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $data_transaksi->province}}</td>
                                </tr>
                                <tr>
                                    <th>Produk</th>
                                    <td>
                                        @foreach ($data_transaksi->produk as $data_produk)
                                        <li>
                                            <a href="{{ route('product.show',$data_produk->id) }}">
                                                {{ $data_produk->product_name}}
                                            </a>
                                        </li>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($data_transaksi->status == 'delivered')
                        <button type="submit" class="btn btn-warning"
                            onclick="return confirm('Anda yakin ingin mengedit data ini?')">Edit Status</button>
                        </form>
                        @endif

                        @if ($data_transaksi->status == 'unverified')
                        <button type="submit" class="btn btn-warning"
                            onclick="return confirm('Anda yakin ingin mengedit data ini?')">Edit Status</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.container-fluid -->




@endsection