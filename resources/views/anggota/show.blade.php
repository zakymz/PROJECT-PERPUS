@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Detail anggota Perpustakaan {{ $anggota->relatedUser->name }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('anggota.index') }}">anggota Perpustakaan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('anggota.show', $anggota->id) }}">Detail anggota Perpustakaan</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title -->


        <div class="row">

            <div class="col-md-12 mb-3">
                <a href="{{ route('anggota.index') }}" class="btn btn-primary float-right"><i class="fa-light fa-circle-arrow-left"></i> Kembali</a>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 d-flex justify-content-between">
                                <h6 class="font-weight-bold mb-3">Detail anggota Perpustakaan {{ $anggota->relatedUser->name }}</h6>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hovered table-bordered table-striped">
                                        <tr>
                                            <th>Kode anggota</th>
                                            <td>: {{ $anggota->no_anggota }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>: {{ $anggota->relatedUser->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>: {{ $anggota->relatedUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>No HP</th>
                                            <td>: {{ $anggota->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>: {{ $anggota->jk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>: {{ TanggalID('j M Y', $anggota->tgl_lahir) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{ $anggota->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Di Buat Oleh</th>
                                            <td>: {{ $anggota->relatedCreatedBy->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Di Update Oleh</th>
                                            <td>: {{ $anggota->relatedUpdatedBy->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dibuat tanggal</td>
                                            <td>{{ TanggalID('j M Y H:i', $anggota->created_at) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Diupdate tanggal</td>
                                            <td>
                                                @if ($anggota->updated_at != null)
                                                {{ TanggalID('j M Y H:i', $anggota->updated_at) }}
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

        </div>

    </div>

</div>
<!-- content -->
@endsection

@push('plugin-js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endpush

