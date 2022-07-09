@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Detail Pegawai Perpustakaan {{ $pegawai->relatedUser->name }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('pegawai.index') }}">Pegawai Perpustakaan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('pegawai.show', $pegawai->id) }}">Detail Pegawai Perpustakaan {{ $pegawai->relatedUser->name }}</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title -->


        <div class="row">

            <div class="col-md-12 mb-3">
                <a href="{{ route('pegawai.index') }}" class="btn btn-primary float-right"><i class="fa-light fa-circle-arrow-left"></i> Kembali</a>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 d-flex justify-content-between">
                                <h6 class="font-weight-bold mb-3">Detail Pegawai Perpustakaan {{ $pegawai->relatedUser->name }}</h6>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hovered table-bordered table-striped">
                                        <tr>
                                            <th>Kode Pegawai</th>
                                            <td>: {{ $pegawai->no_pegawai }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>: {{ $pegawai->relatedUser->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>: {{ $pegawai->relatedUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>No HP</th>
                                            <td>: {{ $pegawai->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>: {{ $pegawai->jk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>: {{ TanggalID('j M Y', $pegawai->tgl_lahir) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{ $pegawai->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Di Buat Oleh</th>
                                            <td>: {{ $pegawai->relatedCreatedBy->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Di Update Oleh</th>
                                            <td>: {{ $pegawai->relatedUpdatedBy->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dibuat tanggal</td>
                                            <td>{{ TanggalID('j M Y H:i', $pegawai->created_at) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Diupdate tanggal</td>
                                            <td>
                                                @if ($pegawai->updated_at != null)
                                                {{ TanggalID('j M Y H:i', $pegawai->updated_at) }}
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

