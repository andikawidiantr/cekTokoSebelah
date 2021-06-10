@extends('main')

@section('isi')
    
<!-- Begin Page Content -->
<div class="panel panel-primary">
    <div class="panel panel-heading">
        <div class="panel-title text-center">
            <h2><label>ADD RESPONSE</label></h2>
        </div>
        <p class="panel-subtitle text-center">Form Membalas Review Pembeli</p>
    </div>
    <form action="/admin/product/upload/response/{{ $id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-md-1"><label>Admin</label> </h5>
                <div class="col-md-11">
                    <input disabled name="admin_id" type="text" class="form-control" placeholder="{{Auth::guard('admin')->user()->name}}"><span class="error text-danger"><p id="courier_error"></p></span>
                </div>
            </div>
            <div class="row">
                <h5 class="col-md-1"><label>Respon</label> </h5>
                <div class="col-md-11">
                    <input  id="content" name="content" type="text" class="form-control" placeholder="Respon..."><span class="error text-danger"></span>
                </div>
            </div>
        </div>
        <div class="panel panel-footer">
            <a href="/admin/product/{{$data_review->product_id}}" class="btn btn-info ">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            
            <button value="submit" type="submit" class="btn btn-outline-primary pull-right">
                <i class="fa fa-paper-plane"></i> Save
            </button>
        </div>
    </form>
</div>

@endsection