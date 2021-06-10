@extends('user-layout')
<!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
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
    <br><br>
                            <!-- Header -->
                            <h1 class="header text-uppercase text-center">
                                Notifikasi
                                {{-- <span>
                                    Foto/Screenshot bukti transfer
                                </span> --}}
                            </h1>

                            <!-- Data -->
                            <div class="form-group">
                                <table class="table table-hover " align="center">
                                    <tbody>
                                        
                                        
                                        @foreach ($data_usernotofikassi as $item)
                                            @php
                                            $data = json_decode($item->data);
                                            @endphp
                                            <tr>
                                                <th><i class="fas fa-bell fa-fw"></i></i></th>
                                                <td>{{ $data->nama }} {{ $data->massage}}</td>
                                                <td>{{ date("d F Y", strtotime($item->created_at)) }}</td>
                                                <td class="text-center">
                                                    <!-- info btn -->
                                                    <a href="/shop/uploadbukti/{{ $data->id}}" onclick="read('{{$item->id}}')" class=" btn btn-primary btn-sm">
                                                        <i class="fas fa-book-reader"></i>
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
            </div>
        </div>
    </div>
    <!-- END: CONTENT -->
</div>
<br><br>
@endsection