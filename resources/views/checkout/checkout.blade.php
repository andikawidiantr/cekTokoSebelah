@extends('user')
@section('title', 'Checkout')
@section('page-contents')

    <!-- Page Content -->
    <div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Checkout</h1>
            <span>Checkout Pesanan Anda</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Information -->
     <form action="#">
    <div class="contact-information2">
     <div class="container">
       <div class="row">
           <div class="col-12">
               <div class="table-responsive">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                              <th></th>
                              <th scope="col" class="text-left">Product</th>
                              <th scope="col" class="text-center">Price</th>
                              <th scope="col" class="text-center">Quantity</th>
                              <th scope="col" class="text-center">Weight</th>
                              <th scope="col" class="text-center">Total Price</th>
                           </tr>
                       </thead>
                       <tbody>
                         @foreach($cart as $item )
                              @foreach ($product as $id)
                                   @if ($item->product_id == $id)
                                        @php $subtotal = $item->product->price * $item->qty @endphp
                                        <tr>
                                             <td class="align-center" hidden>{{ $item->product_id }}</td>
                                             <td><img class="rounded mx-auto d-block" src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                                             <td>{{ $item->product->product_name }}</td>
                                             <td class="text-center">{{ "Rp" . number_format($item->product->price, 0, ",", ",") }}</td>
                                             <td class="text-center">{{ $item->qty }}</td>
                                             <td class="text-center">{{ $item->product->weight }}kg</td>
                                             <td class="text-center">{{ "Rp" . number_format($subtotal, 0, ",", ",") }}</td>
                                        </tr>
                                   @endif
                              @endforeach
                         @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
     </div>
   </div>

    <!-- Shipping Information -->
    <div class="callback-form contact-us" style="margin-top: 35px; padding-top: 55px; padding-bottom: 55px;">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="contact-form">
               <div class="row">
                    <div class="col-sm-6 col-xs-12">
                         <div class="form-group">
                              <select name="provinsi" class="form-control">
                                   <option value="">-- Pilih Provinsi --</option>
                                   @foreach ($province as $provinsi => $value)
                                        <option value="{{ $provinsi }}">{{ $value }}</option>
                                   @endforeach
                              </select>
                         </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                         <div class="form-group">
                              <select name="kota" class="form-control">
                                   <option value="">-- Pilih Kota/Kabupaten --</option>
                              </select>
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-sm-6 col-xs-12">
                         <div class="form-group">
                              <select class="form-control">
                                   <option value="">-- Pilih Jasa Ekspedisi --</option>
                                   @foreach ($courier as $couriers => $value)
                                        <option value="{{ $couriers }}">{{ $value }}</option>
                                   @endforeach
                              </select>
                         </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                         <div class="form-group">
                              <input type="text" class="form-control" placeholder="Nama Jalan/Gedung, No. Rumah, Kecamatan, Kelurahan, Kode Pos">
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-sm-6 col-xs-12">
                         <div class="form-group">
                              <input type="text" class="form-control" placeholder="Nama Lengkap">
                         </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                         <div class="form-group">
                              <input type="text" class="form-control" placeholder="Nomor Handphone">
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-sm-12 col-xs-12">
                         <div class="form-group">
                              <select class="form-control">
                                   <option value="">-- Choose Payment method --</option>
                                   <option value="bni">BNI Virtual Account</option>
                                   <option value="bca">BCA Virtual Account</option>
                                   <option value="bri">BRI Virtual Account</option>
                                   <option value="mandiri">MANDIRI Virtual Account</option>
                              </select>
                         </div>
                    </div>
               </div>
           </div>
         </div>
       </div>
     </div>
   </div>

    <!-- Total Information -->
    <div class="contact-information2">
      <div class="container">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="row">
                  <div class="col-6">
                       <em>Sub-total untuk Produk</em>
                  </div>
                  
                  <div class="col-6 text-right">
                       <strong>Rp. 0</strong>
                  </div>
             </div>
          </li>
          
          <li class="list-group-item">
               <div class="row">
                    <div class="col-6">
                         <em>Potongan</em>
                    </div>

                    <div class="col-6 text-right">
                         <strong>Rp. 0</strong>
                    </div>
               </div>
          </li>

          <li class="list-group-item">
               <div class="row">
                    <div class="col-6">
                         <em>Total Ongkos Kirim</em>
                    </div>

                    <div class="col-6 text-right">
                         <strong>Rp. 0</strong>
                    </div>
               </div>
          </li>

          <li class="list-group-item">
               <div class="row">
                    <div class="col-6">
                         <em>Total Pembayaran</em>
                    </div>

                    <div class="col-6 text-right">
                         <strong>Rp. 0</strong>
                    </div>
               </div>
          </li>
        </ul>
      </div>
      <div div class="col-sm-12 mt-4">
          <div class="d-flex justify-content-center">
               <button type="submit" id="form-submit" class="btn btn-success">Buat Pesanan</button>
          </div>
     </div>   
    </div>
     </form>

    <!-- Footer Starts Here -->
    @endsection

    <!-- Bootstrap core JavaScript -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Additional Scripts -->
    <script src="{{asset('styleuser/mobile/assets/js/custom.js')}}"></script>
    <script src="{{asset('styleuser/mobile/assets/js/owl.js')}}"></script>
    <script src="{{asset('styleuser/mobile/assets/js/slick.js')}}"></script>
    <script src="{{asset('styleuser/mobile/assets/js/accordions.js')}}"></script>

    <script>
         $(document).ready(function () {
          $('select[name="provinsi"]').on('change', function() {
               let provinceId = $(this).val();
               if (provinceId) {
                    jQuery.ajax({
                         url: '/province/'+provinceId+'/cities',
                         type: 'GET',
                         dataType: 'json',
                         success:function(data) {
                              $('select[name="kota"]').empty();
                              $.each(data, function(key, value) {
                                   $('select[name="kota"]').append('<option value="'+key+'">'+value+'</option>');
                              });
                         },
                    });
               } else {
                    $('select[name="kota"]').empty();
                    $('select[name="kota"]').append('<option value="">-- Pilih Kota/Kabupaten --</option>');
               }
          });
         });
    </script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

