@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Riwayat Peminjaman Kamu</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('riwayat.index') }}">Riwayat Peminjaman Kamu</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title -->


        <div class="row">

            @forelse ($transactions as $transaction)
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Peminjaman Tanggal {{ TanggalID('j M Y', $transaction->tgl_pinjam) }}</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-unstyled">
                                    <li class="media">
                                        <a data-fancybox="gallery" href="{{ $transaction->relatedBuku->cover ?? url('assets/images/default-cover.png')  }}">
                                            <img src="{{ $transaction->relatedBuku->cover ?? url('assets/images/default-cover.png') }}" style="width: 90px;" alt="">
                                        </a>
                                        <div class="media-body ml-2">
                                            <h5 class="mt-0 mb-1">{{ $transaction->relatedBuku->judul }}</h5>
                                            <span>Pengarang : {{ $transaction->relatedBuku->pengarang }}</span> <br/>
                                            <span>Penerbit : {{ $transaction->relatedBuku->penerbit }}</span> <br/>
                                            <span>Tahun Terbit : {{ $transaction->relatedBuku->tahun_terbit }}</span> <br/>
                                            @if ($transaction->status == 'pinjam')
                                                <span class="badge badge-warning">Dipinjam</span>
                                            @elseif ($transaction->status == 'kembali')
                                                <span class="badge badge-success">Dikembalikan</span>
                                            @else
                                                <span class="badge badge-danger">Hilang</span>
                                            @endif <br/>
                                            <span class="text-primary">Tanggal Harus Di Kembalikan : {{ TanggalID('j M Y', $transaction->tgl_berakhir) }}</span>
                                            <span>Tanggal Kembali : 
                                                @if ($transaction->status == 'pinjam')
                                                    <span class="text-danger">Belum Dikembalikan</span>
                                                @elseif ($transaction->status == 'kembali')
                                                    {{ TanggalID('j M Y', $transaction->tgl_kembali) }}
                                                @else 
                                                    <span class="text-danger">Hilang</span>
                                                @endif
                                            </span> <br/>
                                            @if ($transaction->denda != 0)
                                                <span>Denda : Rp. {{ formatUang($transaction->denda) }}</span>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <h5 class="font-weight-bold" style="color: #ccc">Belum ada peminjaman buku..</h5>
            @endforelse

            <div class="col-md-12">
                {{ $transactions->links() }}
            </div>
        </div>

    </div>

</div>
<!-- content -->
@endsection

@push('plugin-js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endpush

@push('custom-js')

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

@endpush
