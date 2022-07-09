@extends('layouts.app')

@push('plugin-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Detail Buku {{ $buku->judul }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('buku.index') }}">Buku</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('buku.show', $buku->id) }}">Detail Buku {{ $buku->judul }}</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title -->


        <div class="row">

            <div class="col-md-12 mb-3">
                <a href="{{ route('buku.index') }}" class="btn btn-primary float-right"><i class="fa-light fa-circle-arrow-left"></i> Kembali</a>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
        
                            <div class="col-12 d-flex justify-content-between">
                                <h6 class="font-weight-bold mb-3">Detail Data Buku {{ $buku->judul }}</h6>
                            </div>
        
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hovered table-bordered tablestriped" >
                                        <tr>
                                            <th>Judul</th>
                                            <td>: {{ $buku->judul }}</td>
                                        </tr>
                                        <tr>
                                            <th>ISBN</th>
                                            <td>: {{ $buku->isbn }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pengarang</th>
                                            <td>: {{ $buku->pengarang }}</td>
                                        </tr>
                                        <tr>
                                            <th>Penerbit</th>
                                            <td>: {{ $buku->penerbit }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Terbit</th>
                                            <td>: {{ $buku->tahun_terbit }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Buku</th>
                                            <td>: {{ $buku->jumlah_buku }} Buku</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>: {{ $buku->lokasi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Cover</th>
                                            <td>
                                                <a data-fancybox="gallery" href="{{ $buku->cover ?? url('assets/images/default-cover.png')  }}">
                                                    <img src="{{ $buku->cover ?? url('assets/images/default-cover.png') }}" style="width: 50px;" alt="">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Di Buat Oleh</th>
                                            <td>: {{ $buku->relatedCreatedBy->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Di Update Oleh</th>
                                            <td>: {{ $buku->relatedUpdatedBy->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dibuat tanggal</td>
                                            <td>{{ TanggalID('j M Y H:i', $buku->created_at) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Diupdate tanggal</td>
                                            <td>
                                                @if ($buku->updated_at != null)
                                                {{ TanggalID('j M Y H:i', $buku->updated_at) }}
                                                @else
                                                -
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Deskripsi Buku {{ $buku->judul }}</h4>
                        <p>{!! $buku->deskripsi !!}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- content -->
@endsection

@push('plugin-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endpush