@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Peminjaman Buku</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('transaction.index') }}">Peminjaman Buku</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title -->


        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-12 d-flex justify-content-between">
                        <h6 class="font-weight-bold mb-3">Data Peminjaman Buku</h6>
                        <a href="{{ route('transaction.create') }}" class="btn btn-primary font-weight-bold mb-3" ><i class="fa fa-plus"></i> Buat Peminjaman Baru</a>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pegawai</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Akhir Pinjam</th>
                                        <th>Anggota</th>
                                        <th>Buku</th>
                                        <th>Tgl Kembali</th>
                                        <th>Denda</th>
                                        <th>Status</th>
                                        <th>Ket</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->relatedPegawai->relatedUser->name }}</td>
                                            <td>{{ TanggalID('j M Y', $item->tgl_pinjam) }}</td>
                                            <td>{{ TanggalID('j M Y', $item->tgl_berakhir) }}</td>
                                            <td>{{ $item->relatedAnggota->relatedUser->name }}</td>
                                            <td>{{ $item->relatedBuku->judul }}</td>
                                            <td>
                                                @if ($item->tgl_kembali != null)
                                                    {{ TanggalID('j M Y', $item->tgl_kembali) }}
                                                @else
                                                    Belum Dikembalikan
                                                @endif
                                            </td>
                                            <td>
                                                {{ formatUang($item->denda) }}
                                            </td>
                                            <td>
                                                @if ($item->status == 'pinjam')
                                                    <span class="badge badge-warning">Dipinjam</span>
                                                @elseif ($item->status == 'kembali')
                                                    <span class="badge badge-success">Dikembalikan</span>
                                                @else
                                                    <span class="badge badge-danger">Hilang</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('transaction.show', $item->id) }}" class="btn btn-primary"><i class="fa fa-info-circle"></i> Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('custom-js')

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

@endpush
