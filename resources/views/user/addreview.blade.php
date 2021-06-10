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
    <section class="py-10 bg-light">
        <div class="container">
        
            <div class="list-body">
                <div class="profile-main text-center"><br>

                    <br>
                    <form class="form-horizontal" method="POST" action="/produk/review" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-center">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="col-sm-12">
                                
                                    <h1>{{$product->product_name }}</h1>
                             
                            </div>
                            <div class="col-sm-12">

                                <select name="rate" class="form-control" id="exampleFormControlSelect1"
                                    style="padding: 0px ">
                                    <option selected disabled>Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <textarea name="content" class="form-control" id="inputcomment" cols="30"
                                    rows="2"></textarea>
                            </div>
                        </div>
                        <div class="form-group " align="center">
                            <a type="submit" class="btn btn-primary btn-material" href="/transaksi">
                                <span class="body" href="/transaksi">Back</span>
                                <i class="icon icofont icofont-check-circled"></i>
                            </a>
                            <button type="submit" class="btn btn-primary btn-material" href="/shop">
                                <span class="body" href="/shop">Kirim Ulasan</span>
                                <i class="icon icofont icofont-check-circled"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            </h1>

            <br><br>

        </div>

    </section>

</div>

<br>
@endsection