@extends('main')
@section('head')
<!-- <script src="{{asset('style/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('style/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('isi')

<!-- Page Heading -->

<!-- Content Row -->

<div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="metric">
                <span class="icon"><i class="fa fa-shopping-bag"></i></span>

                @if (date('m')==1)
                <p>
                    <span class="number">Rp.{{number_format($jan)}}</span>
                    <span class="title">Earnings (Januari)</span>
                </p>

                @elseif(date('m')==2)

                <div span="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Februari)</div>
                <div span="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($feb)}}</div>

                @elseif(date('m')==3)

                <div span="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Maret)</div>
                <div span="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($mar)}}</div>

                @elseif(date('m')==4)

                <div span="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (April)</div>
                <div span="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($apr)}}</div>

                @elseif(date('m')==5)

                <div span="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Mei)</div>
                <div span="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($mei)}}</div>

                @elseif(date('m')==6)
                <p>
                    <span class="number">Rp.{{number_format($jun)}}</span>
                    <span class="title">Earnings (Juni)</span>
                </p>

                @elseif(date('m')==7)

                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Juli)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($jul)}}</div>

                @elseif(date('m')==8)

                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Agustus)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($augs)}}</div>

                @elseif(date('m')==9)

                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (September)
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($mei)}}</div>

                @elseif(date('m')==10)

                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Oktober)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($okt)}}</div>

                @elseif(date('m')==11)

                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (November)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($nov)}}</div>

                @elseif(date('m')==12)

                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Desember)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format($des)}}</div>

                @endif

                </span>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-4">
        <div class="panel">
            <div class="metric">
                <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                <p>
                    <span class="number">{{ \App\product::all()->count() }}</span>
                    <span class="title">Jumlah Barang</span>
                </p>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->

    <!-- Earnings (Monthly) Card Example -->

    <!-- Earnings (Monthly) Card Example -->


    <!-- Pending Requests Card Example -->
    <div class="col-md-4">
        <div class="panel">
            <div class="metric">
                <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                <p>
                    <span class="number">{{ \App\User::all()->count() }}</span>
                    <span class="title">Jumlah User</span>
                </p>
            </div>
        </div>
    </div>
</div>


<!-- Content Row -->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <!-- MULTI CHARTS -->
        <div class="panel">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Penjualan Pertahun</h2>
               
            </div>
            <div class="panel-body">
                <div>
                    <canvas class="" id="newchart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
        <!-- END MULTI CHARTS -->
    </div>

</div>



@endsection
@section('script')
<!-- <script src="{{asset('style/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('style/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('style/assets/vendor/chartist/js/chartist.min.js')}}"></script> -->
<script src="{{asset('style/assets/scripts/klorofil-common.js')}}"></script>

<script>
$(function() {
    console.log();
    var data = {
            type: 'line',
            data: {
                labels: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
                datasets: [{
                    label: 'Transaksi Sukses',
                    data: {!! json_encode($data_sukses_tahun) !!},
                    backgroundColor: [
                        'rgba(0, 182, 28, 1)',
                    ],
                    borderColor: [
                        'rgba(0, 182, 28, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Transaksi Sedang Berlangsung',
                    data: {!! json_encode($data_proses_tahun) !!},
                    backgroundColor: [
                        'rgba(75, 42, 255, 1)',
                    ],
                    borderColor: [
                        'rgba(75, 42, 255, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Transaksi Dibatalkan',
                    data: {!! json_encode($data_cancel_tahun) !!},
                    backgroundColor: [
                        'rgba(255, 70, 42, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 70, 42, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks:{
                            stepSize:10,
                            count:5,
                            precision:0,
                        },
                        suggestedMax:30,
                    }
                },
                legend: {
                    onClick: function (e) {
                        e.stopPropagation();
                    }
                }
            }
        };
        var ctx = document.getElementById('newchart').getContext('2d');
        var mychart = new Chart(ctx,data);
		
	});
</script>

@endsection