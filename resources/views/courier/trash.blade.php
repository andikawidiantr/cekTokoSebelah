@extends('main')

@section('isi')
 
{{-- PESAN FEED BACK --}}
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <i class="fa fa-check-circle"> {{Session::get('success')}}</i>
</div>
@endif


@if(Session::has('delete'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <i class="fa fa-times-circle"> {{Session::get('delete') }}</i>
</div>
@endif

@if(Session::has('gagal'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <i class="fa fa-times-circle"> {{Session::get('gagal') }}</i>
</div>
@endif
<br>

<div class="panel">
    <div class="panel panel-heading">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-left"><b>Courier </b> Deleted List</h2>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2"><br>
                <div class="align-right">
                    <a href="/guru/kembalikan_semua" type="button" class="buton success pull-right"
                        class="text-align:justify;">
                        Restore All
                    </a>
                </div>
            </div>
            <div class="col-md-2"><br>
                <div class="align-left">
                    <a href="/guru/hapus_permanen_semua" type="button" class="buton danger pull-left"
                        class="text-align:justify;">
                        Delete All
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Courier</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{$loop->iteration }}</td>
                    <td class="text-center">{{$item->courier}}</td>
                    <td class="text-center">
                            {{-- TOMBOL RESTORE --}}
                            <a href="/guru/kembalikan/{{ $item->id }}" type="button"
                                class="btn btn-success btn-xs">
                                <i class="fa fa-window-restore"> Restore</i>
                            </a>
                            {{-- TOMBOL DELETE --}}
                            <a href="/guru/hapus_permanen/{{ $item->id }}" type="submit" name="submit"
                                onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                class="btn btn-danger btn-xs">
                                Delete <i class="fa fa-trash"></i>
                            </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="3">
                        <p>Tidak ada data</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class=" panel-footer">
        <a href="{{ route('courier.index') }}" class="btn btn-info ">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
<link rel="stylesheet" href="{{asset('style/assets/css/buatan.css')}}">
@endsection