@extends('main')

@section('isi')
    
<!-- Begin Page Content -->
<div class="panel">

        <!-- Begin Page Content -->
        <div class="panel">
  
            <!-- DataTales Example -->
            <div class="panel panel-heading">
                
                    <h2 class="text-center"><b>Transaction</b> List</h2>
             <br>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">
                                All
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="verified-tab" data-toggle="tab" href="#verified" role="tab" aria-controls="verified" aria-selected="false">
                                Verified
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="delivered-tab" data-toggle="tab" href="#delivered" role="tab" aria-controls="delivered" aria-selected="false">
                                Delivered
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="success-tab" data-toggle="tab" href="#success" role="tab" aria-controls="success" aria-selected="true">
                                Success
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="expired-tab" data-toggle="tab" href="#expired" role="tab" aria-controls="expired" aria-selected="false">
                                Expired
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="unverified-tab" data-toggle="tab" href="#unverified" role="tab" aria-controls="unverified" aria-selected="false">
                                Unverified
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">
                                Canceled
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Jatuh Tempo Pembayaran</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_transaksi as $transaksi)
                                    <tr>
                                        <td class="text-center">{{ date("d F Y", strtotime($transaksi->timeout)) }}</td>
                                        <td class="text-center">{{ $transaksi->user->name}}</td>
                                        <td class="text-center">{{ $transaksi->address}}</td>
                                        <td class="text-center">{{ $transaksi->regency}}</td>
                                        <td class="text-center">{{ $transaksi->province}}</td>
                                        <td class="text-center">Rp.{{ number_format($transaksi->total) }}</td>
                                        <td class="text-center">{{ $transaksi->status}}</td>
                                        <td class="text-center">
                                            <a href="/admin/detail-transaksi/{{ $transaksi->id }}" class="btn btn-info btn-circle btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="verified" role="tabpanel" aria-labelledby="verified-tab">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Jatuh Tempo Pembayaran</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_transaksi as $transaksi)
                                        @if($transaksi->status=='verified')
                                        <tr>
                                            <td>{{ date("d F Y", strtotime($transaksi->timeout)) }}</td>
                                            <td>{{ $transaksi->user->name}}</td>
                                            <td>{{ $transaksi->address}}</td>
                                            <td>{{ $transaksi->regency}}</td>
                                            <td>{{ $transaksi->province}}</td>
                                            <td>Rp.{{ number_format($transaksi->total) }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-transaksi/{{ $transaksi->id }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> 
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Jatuh Tempo Pembayaran</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_transaksi as $transaksi)
                                        @if($transaksi->status=='delivered')
                                        <tr>
                                            <td>{{ date("d F Y", strtotime($transaksi->timeout)) }}</td>
                                            <td>{{ $transaksi->user->name}}</td>
                                            <td>{{ $transaksi->address}}</td>
                                            <td>{{ $transaksi->regency}}</td>
                                            <td>{{ $transaksi->province}}</td>
                                            <td>Rp.{{ number_format($transaksi->total) }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-transaksi/{{ $transaksi->id }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> 

                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="success" role="tabpanel" aria-labelledby="success-tab">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Jatuh Tempo Pembayaran</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_transaksi as $transaksi)
                                        @if($transaksi->status=='success')
                                        <tr>
                                            <td>{{ date("d F Y", strtotime($transaksi->timeout)) }}</td>
                                            <td>{{ $transaksi->user->name}}</td>
                                            <td>{{ $transaksi->address}}</td>
                                            <td>{{ $transaksi->regency}}</td>
                                            <td>{{ $transaksi->province}}</td>
                                            <td>Rp.{{ number_format($transaksi->total) }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-transaksi/{{ $transaksi->id }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> 

                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Jatuh Tempo Pembayaran</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_transaksi as $transaksi)
                                        @if($transaksi->status=='expired')
                                        <tr>
                                            <td>{{ date("d F Y", strtotime($transaksi->timeout)) }}</td>
                                            <td>{{ $transaksi->user->name}}</td>
                                            <td>{{ $transaksi->address}}</td>
                                            <td>{{ $transaksi->regency}}</td>
                                            <td>{{ $transaksi->province}}</td>
                                            <td>Rp.{{ number_format($transaksi->total) }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-transaksi/{{ $transaksi->id }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> 

                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="unverified" role="tabpanel" aria-labelledby="unverified-tab">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Jatuh Tempo Pembayaran</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_transaksi as $transaksi)
                                        @if($transaksi->status=='unverified')
                                        <tr>
                                            <td class="text-center">{{ date("d F Y", strtotime($transaksi->timeout)) }}</td>
                                            <td class="text-center">{{ $transaksi->user->name}}</td>
                                            <td class="text-center">{{ $transaksi->address}}</td>
                                            <td class="text-center">{{ $transaksi->regency}}</td>
                                            <td class="text-center">{{ $transaksi->province}}</td>
                                            <td class="text-center">Rp.{{ number_format($transaksi->total) }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-transaksi/{{ $transaksi->id }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> 

                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Jatuh Tempo Pembayaran</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Total Pembayaran</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_transaksi as $transaksi)
                                        @if($transaksi->status=='canceled')
                                        <tr>
                                            <td >{{ date("d F Y", strtotime($transaksi->timeout)) }}</td>
                                            <td>{{ $transaksi->user->name}}</td>
                                            <td>{{ $transaksi->address}}</td>
                                            <td>{{ $transaksi->regency}}</td>
                                            <td>{{ $transaksi->province}}</td>
                                            <td>Rp.{{ number_format($transaksi->total) }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-transaksi/{{ $transaksi->id }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> 
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
  
        </div>
        <!-- /.container-fluid -->

</div>
<!-- /.container-fluid -->

@endsection