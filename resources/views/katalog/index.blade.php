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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('katalog.search') }}" method="get">
                            <div class="row">

                                <div class="input-group is-invalid col-12">
                                    <div class="custom-file">
                                      <input type="search" name="judul" class="form-control" value="{{ request()->get('judul') }}" id="" placeholder="Cari judul buku...">
                                    </div>
                                    <div class="input-group-append">
                                       <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @forelse ($buku as $item)
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-unstyled">
                                    <li class="media">
                                        <a data-fancybox="gallery" href="{{ $item->cover ?? url('assets/images/default-cover.png')  }}">
                                            <img src="{{ $item->cover ?? url('assets/images/default-cover.png') }}" style="width: 90px;" alt="">
                                        </a>
                                        <div class="media-body ml-2">
                                            <h5 class="mt-0 mb-1">{{ $item->judul }}</h5>
                                            <span>Pengarang : {{ $item->pengarang }}</span> <br/>
                                            <span>Penerbit : {{ $item->penerbit }}</span> <br/>
                                            <span>Tahun Terbit : {{ $item->tahun_terbit }}</span> <br/>
                                            <span>Lokasi Buku : {{ $item->lokasi }}</span> <br/>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <h5 class="font-weight-bold" style="color: #cccc">Belum ada buku yang diinput...</h5>
            @endforelse

            <div class="col-md-12">
                {{ $buku->links() }}
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
