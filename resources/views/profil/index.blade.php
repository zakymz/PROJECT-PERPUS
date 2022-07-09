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
                    <h4 class="page-title">Profil Kamu</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('profil.index') }}">Profil Kamu</a>
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
                        <div class="row">

                            <div class="col-md-12">

                                <table width="100%">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $anggota->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $anggota->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td>******</td>
                                    </tr>
                                    <tr>
                                        <th>NO HP</th>
                                        <td>{{ $anggota->relatedAnggota->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $anggota->relatedAnggota->jk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tgl Lahir</th>
                                        <td>{{ $anggota->relatedAnggota->tgl_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $anggota->relatedAnggota->alamat }}</td>
                                    </tr>
                                </table>

                            </div>

                            <div class="col-md-12 mt-2">
                                <a href="#modal-edit-profil" data-toggle="modal" class="btn btn-primary btn-block"><i class="fa fa-user-edit"></i> Ubah Password</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- content -->

{{-- modal edit --}}
<div class="modal fade" id="modal-edit-profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Password Kamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('profil.update', $anggota->id) }}" method="post"> @csrf @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ $anggota->email }}" id="" class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Password Baru</label>
                        <input type="password" name="password" class="form-control" id="">
                        <span class="font-10 text-primary">jika tidak ingin merubah password kosongkan saja!</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- modal edit --}}
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
