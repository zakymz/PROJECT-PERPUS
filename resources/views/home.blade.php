@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
@endpush

@push('customer-css')
@push('custom-css')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 800px;
        margin: 1em auto;
    }
    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        bpinjam-collapse: collapse;
        bpinjam: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
    .ld-label {
        width: 200px;
        display: inline-block;
    }
    .ld-url-input {
        width: 500px;
    }
    .ld-time-input {
        width: 40px;
    }
</style>

@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- <div class="row align-items-center mb-4">
                <div class="col-sm-12">
                    <div class="alert alert-primary" role="alert">
                    </div>
                </div>

            </div> --}}
            {{-- end row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Dashboard</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Perpustakaan</a></li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title -->

        <div class="row">

            <div class="col-md-12">
                <div class="alert alert-primary">
                    Selamat Datang {{ auth()->user()->name }} 
                    @if (auth()->user()->role == 'superadmin')
                        (Super Admin)
                    @elseif (auth()->user()->role == 'pegawai')
                        (Pegawai Perpustakaan)
                    @elseif (auth()->user()->role == 'anggota')
                        (Anggota Perpustakaan)
                    @endif
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card bg-primary text-white">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="fa-light fa-ballot-check bg-light text-primary"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Peminjaman</h5>
                        </div>
                        <h3 class="mt-4 font-16">{{ $pinjam }}</h3>
                        <p class="text-muted mt-2 mb-0"></p>
                    </div>
                </div>
            </div>

            @if (auth()->user()->role != 'anggota')
            <div class="col-sm-6 col-xl-3">
                <div class="card bg-light text-dark">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="fa-light fa-books bg-primary text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Buku</h5>
                        </div>
                        <h3 class="mt-4 font-16">{{ $buku }}</h3>
                        <p class="text-muted mt-2 mb-0"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card bg-light text-dark">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="fa-light fa-users bg-primary text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Anggota</h5>
                        </div>
                        <h3 class="mt-4 font-16">{{ $anggota }}</h3>
                        <p class="text-muted mt-2 mb-0"></p>
                    </div>
                </div>
            </div>

            @endif

            @if (auth()->user()->role == 'superadmin')
            <div class="col-sm-6 col-xl-3">
                <div class="card bg-light text-dark">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="fa-light fa-user-tie bg-primary text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Pegawai</h5>
                        </div>
                        <h3 class="mt-4 font-16">{{ $pegawai }}</h3>
                        <p class="text-muted mt-2 mb-0"></p>
                    </div>
                </div>
            </div>
            @endif

            @if (auth()->user()->role != 'anggota')
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Diagram Peminjaman Buku</h4>
                        <figure class="highcharts-figure">
                            <div id="peminjamanDiagram"></div>
                        </figure>
                    </div>
                </div>
            </div>
            @endif

            {{-- <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">AKTIFITAS CS</h4>
                        <ol class="activity-feed mb-0">
                            @foreach ($activitys as $activity)
                            <li class="feed-item">
                                <div class="feed-item-list">
                                    <p class="text-muted mb-1">{{ TanggalID('j M Y H:i', $activity->created_at) }}</p>
                                    <p class="mb-0 text-primary">by: {{ $activity->relatedUser->name }}</p>
                                    <p class="font-15 mt-0 mb-0">{{ $activity->description }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ol>
                        <a href="{{ route('activitylog.index') }}" class="btn btn-primary btn-block">Lihat Semua Aktifitas</a>
                    </div>
                </div>
            </div> --}}

        </div>

    </div>

</div>
<!-- content -->
@endsection

@push('plugin-js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
{{-- diagram cdn --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/dumbbell.js"></script>
<script src="https://code.highcharts.com/modules/lollipop.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
{{-- diagram cdn --}}
@endpush

@push('custom-js')
<script>
    var januaripinjam     = {{ json_encode($januari_pinjam) }};
    var februaripinjam    = {{ json_encode($februari_pinjam) }};
    var maretpinjam       = {{ json_encode($maret_pinjam) }};
    var aprilpinjam       = {{ json_encode($april_pinjam) }};
    var meipinjam         = {{ json_encode($mei_pinjam) }};
    var junipinjam        = {{ json_encode($juni_pinjam) }};
    var julipinjam        = {{ json_encode($juli_pinjam) }};
    var agustuspinjam     = {{ json_encode($agustus_pinjam) }};
    var septemberpinjam   = {{ json_encode($september_pinjam) }};
    var oktoberpinjam     = {{ json_encode($oktober_pinjam) }};
    var novemberpinjam    = {{ json_encode($november_pinjam) }};
    var desemberpinjam    = {{ json_encode($desember_pinjam) }};
    Highcharts.chart('peminjamanDiagram', {
        chart: {
            type: 'lollipop'
        },
        accessibility: {
            point: {
                valueDescriptionFormat: '{index}. {xDescription}, {point.y}.'
            }
        },
        subtitle: {
            text: ''
        },
        title: {
            text: 'Diagram Peminjaman Perbulan'
        },
        tooltip: {
            shared: true
        },
        xAxis: {
            categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'Desember']
        },
        yAxis: {
        title: {
            text: 'Jumlah Pesanan'
        }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [
        {
            name: 'Pesanan',
            data: [{
                low: januaripinjam
            },{
                low: februaripinjam
            }, {
                low: maretpinjam
            }, {
                low: aprilpinjam
            }, {
                low: meipinjam
            }, {
                low: junipinjam
            }, {
                low: julipinjam
            }, {
                low: agustuspinjam
            }, {
                low: septemberpinjam
            }, {
                low: oktoberpinjam
            }, {
                low: novemberpinjam
            }, {
                low: desemberpinjam
            }]
        },
        ],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
        });
</script>
@endpush