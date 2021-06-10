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

{{-- ------------------------------------------DATA TABLE---------------------------------------- --}}
<div class="panel">
    <div class="panel panel-heading">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-left"><b>Category</b> List</h2>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2"><br>
                <a href="{{ route('category.create') }}" type="button" class="buton info pull-right"
                    class="text-align:justify;">
                    <i class="fa fa-plus"> Add Category</i>
                </a>
            </div>
            <div class="col-md-2"><br>
                <a href="{{ route('category.trash') }}" type="button" class="buton warning pull-left"
                    class="text-align:justify;">
                    <i class="fa fa-trash-o"> Trash </i>
                </a>
            </div>
        </div>
    </div>
    <div class="panel panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center Times">No</th>
                    <th class="text-center Times">Kategori</th>
                    <th class="text-center Times">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{$loop->iteration }}</td>
                    <td class="text-center">{{$item->category_name}}</td>
                    <td class="text-center">
                        {{-- TOMBOL DELETE DAN EDIT --}}
                        <form method="POST">
                            @csrf
                            @method('DELETE')

                            {{-- TOMBOL EDIT --}}
                            <a href="{{ route('category.edit',$item->id) }}" type="button"
                                class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"> EDIT</i>
                            </a>
                            {{-- TOMBOL DELETE --}}
                            <a href="{{ route('category.hapus',$item->id) }}" type="submit" name="submit"
                                onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                class="btn btn-danger btn-xs">
                                DELETE <i class="fa fa-trash"></i>
                            </a>
                        </form>
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
</div>

<link rel="stylesheet" href="{{asset('style/assets/css/buatan.css')}}">

@endsection
