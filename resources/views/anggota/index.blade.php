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
                    <h4 class="page-title">Anggota Perpustakaan</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('anggota.index') }}">Anggota Perpustakaan</a>
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
                        <h6 class="font-weight-bold mb-3">Data Anggota Perpustakaan</h6>
                        <a href="{{ route('anggota.create') }}" class="btn btn-primary font-weight-bold mb-3" ><i class="fa fa-plus"></i> Tambah Anggota</a>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Anggota</th>
                                        <th>Nama</th>
                                        <th>No Hp</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_anggota }}</td>
                                            <td>{{ $item->relatedUser->name }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>{{ $item->jk }}</td>
                                            <td>{{ TanggalID('j M Y', $item->tgl_lahir) }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="{{ route('anggota.show', $item->id) }}" class="btn btn-info"><i class="fa fa-info-circle"></i> Detail</a>
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
        $('.datatable').DataTable();
    </script>

@endpush
