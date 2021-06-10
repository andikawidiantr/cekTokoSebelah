@extends('main')

@section('isi')
    
<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Begin Page Content -->
        <div class="container-fluid">
  
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h1 class=" text-center"><b>Notifikasi</b></h1>
                    <br>
                </div>
                <div class="panel">
                <div class="panel panel-body">
                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                           
                            <tbody>
                                @foreach ($data_adminnotofikassi as $item)

                                @php
                                $data = json_decode($item->data);
                                @endphp

                                <tr>
                                   
                                    <th><i class="fa fa-bell fa-fw"></i></i></th>
                                    <td>{{ $data->nama }} {{ $data->massage}}</td>
                                    <td>{{ date("d F Y", strtotime($item->created_at)) }}</td>
                                    <td class="text-center">
                                        <!-- info btn -->
                                        <a href="/admin/detail-transaksi/{{ $data->id }}" onclick="read('{{$item->id}}')" class=" btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                   

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  
        </div>
        <!-- /.container-fluid -->

</div>
<!-- /.container-fluid -->

@endsection