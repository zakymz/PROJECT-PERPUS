@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/modules/dropify/css/dropify.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Buat Peminjaman Buku Baru</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('transaction.index') }}">Peminjaman</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('transaction.create') }}">Buat Peminjaman Buku Baru</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title -->


        <div class="row">

            <div class="col-md-12 mb-3">
                <a href="{{ route('transaction.index') }}" class="btn btn-primary float-right"><i class="fa-light fa-circle-arrow-left"></i> Kembali</a>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 d-flex justify-content-between">
                                <h6 class="font-weight-bold mb-3">Buat Peminjaman Baru</h6>
                            </div>

                            <div class="col-md-12">
                                <form action="{{ route('transaction.store') }}" method="post" enctype="multipart/form-data"> @csrf
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Pilih Anggota Perpustakaan (Peminjam)<span class="text-danger">*</span></label>
                                                    <select name="anggota_id" id="select2" class="form-control" required>
                                                        <option value="">Pilih Anggota Perpustakaan</option>
                                                        @foreach ($anggota as $item)
                                                        <option value="{{ $item->id }}">{{ $item->relatedUser->name }} - {{ $item->no_anggota }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Tgl Pinjam <span class="text-danger">*</span></label>
                                                    <input type="date" name="tgl_pinjam" required id="" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Tgl Kembali <span class="text-danger">*</span></label>
                                                    <input type="date" name="tgl_kembali" required id="" class="form-control">
                                                    <span class="font-10 text-primary">Kapan Buku Harus Dikembalikan.</span>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Keterangan</label>
                                                    <textarea name="keterangan" class="form-control" id="" rows="3" placeholder="Masukan keterangan"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Pilih Buku Perpustakaan (Buku yang dipinjam)<span class="text-danger">*</span></label>
                                                    <br/>
                                                    <a href="#modal-chose-book" id="" data-toggle="modal" class="btn btn-primary"><i class="fa-light fa-books-medical"></i> Pilih Buku</a>
                                                </div>
                                                <div class="col-md-12">
                                                    <ul class="list-unstyled">
                                                        <li class="media">
                                                          {{-- <img style="width: 100px" src="" class="mr-3" alt="..."> --}}
                                                          <div class="media-body">
                                                              <input type="hidden" name="buku_id" id="buku_id">
                                                            <h5 class="mt-0" style="color: #ccc" id="buku-not-found">Belum Ada Buku Yang Di Pilih</h5>
                                                            <h5 class="mt-0 mb-1" id="judul-buku"></h5>
                                                            <p id="deskripsi"></p>
                                                          </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block">Simpan Data</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- content -->

{{-- modal chose book --}}
<div class="modal fade" id="modal-chose-book" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku as $item)
                                    <tr class="pilih-buku" data-buku-id="{{ $item->id }}" data-judul="{{ $item->judul }}" data-deskripsi="{{ $item->deskripsi }}" >
                                        <td width="7%">{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $item->cover ?? url('assets/images/default-cover.png') }}" style="width: 50px;" alt="">
                                        </td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->pengarang }}</td>
                                        <td class="text-center">
                                            <a href="#!" class="btn btn-success btn-rounded pilih-pelanggan" data-buku-id="{{ $item->id }}" data-judul="{{ $item->judul }}" data-deskripsi="{{ $item->deskripsi }}"><i class="fa fa-check"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
{{-- modal chose book --}}
@endsection

@push('plugin-js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/modules/dropify/js/dropify.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
@endpush

@push('custom-js')

    <script>
        $(document).ready(function() {
            $('#select2').select2();
        });
    </script>

    <script>
        $('.datatable').DataTable();
    </script>

    <script>
        // dropify
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    </script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            });
    </script>

    <script>
        $(document).on('click', '.pilih-buku', function(e) {
            document.getElementById('buku_id').value = $(this).attr('data-buku-id');
            document.getElementById('judul-buku').innerHTML = $(this).attr('data-judul');
            document.getElementById('deskripsi').innerHTML = $(this).attr('data-deskripsi');

            $('#modal-chose-book').hide();
            $('.modal-backdrop').hide();

            $('#buku-not-found').hide();
        });
    </script>

@endpush
