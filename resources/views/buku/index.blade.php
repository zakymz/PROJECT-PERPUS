@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('assets/modules/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Buku</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('buku.index') }}">Buku</a>
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
                        <h6 class="font-weight-bold mb-3">Data Buku</h6>
                        <button class="btn btn-primary font-weight-bold mb-3" data-toggle="modal" data-target="#create-book"> <i class="fa fa-plus"></i> Tambah Buku</button>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Jumlah Buku</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bukus as $buku)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $buku->kode_buku }}</td>
                                            <td>{{ $buku->judul }}</td>
                                            <td>{{ $buku->jumlah_buku }} Buku</td>
                                            <td class="text-right">
                                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-info"><i class="fa fa-info-circle"></i> Detail</a>
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

{{-- modal create book --}}
<div class="modal fade" id="create-book" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data"> @csrf
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Judul Buku <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="judul" value="{{ old('judul_buku') }}" placeholder="Masukan Judul Buku" class="form-control" required id="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">ISBN <span class="text-primary">(Opsional)</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="isbn" value="{{ old('isbn') }}" id="" placeholder="Masukan ISBN" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Pengarang <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="pengarang" value="{{ old('pengarang') }}" required id="" placeholder="Massukan Nama Pengarang" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Penerbit <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="penerbit" value="{{ old('penerbit') }}" required id="" placeholder="Masukan Penerbit" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tahun Terbit <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required id="" placeholder="Masukan Tahun Terbit" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jumlah Buku <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" name="jumlah_buku" value="{{ old('jumlah_buku') }}" required id="" placeholder="Masukan Jumlah Buku" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Lokasi Buku <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select name="lokasi" class="form-control" required id="">
                            <option value="">Pilih Lokasi</option>
                            <option value="rak-1">Rak 1</option>
                            <option value="rak-2">Rak 2</option>
                            <option value="rak-3">Rak 3</option>
                            <option value="rak-4">Rak 4</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-12 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <textarea name="deskripsi" id="editor" class="form-control" placeholder="Masukan Deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-12 col-form-label">Cover Buku <span class="text-primary">(Opsional)</span></label>
                    <div class="col-md-12">
                        <input type="file" class="dropify @error('cover') is-invalid @enderror" name="cover"  data-allowed-file-extensions="jpg jpeg png" />
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul_buku') }}" placeholder="Masukan Judul Buku" class="form-control" required id="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">ISBN <span class="text-primary">(Opsional)</span></label>
                        <input type="text" name="isbn" value="{{ old('isbn') }}" id="" placeholder="Masukan ISBN" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Pengarang <span class="text-danger">*</span></label>
                        <input type="text" name="pengarang" value="{{ old('pengarang') }}" required id="" placeholder="Massukan Nama Pengarang" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Penerbit <span class="text-danger">*</span></label>
                        <input type="text" name="penerbit" value="{{ old('penerbit') }}" required id="" placeholder="Masukan Penerbit" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Tahun Terbit <span class="text-danger">*</span></label>
                        <input type="text" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required id="" placeholder="Masukan Tahun Terbit" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Jumlah Buku <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_buku" value="{{ old('jumlah_buku') }}" required id="" placeholder="Masukan Jumlah Buku" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="editor" class="form-control" placeholder="Masukan Deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Lokasi Buku <span class="text-danger">*</span></label>
                        <select name="lokasi" class="form-control" required id="">
                            <option value="">Pilih Lokasi</option>
                            <option value="rak-1">Rak 1</option>
                            <option value="rak-2">Rak 2</option>
                            <option value="rak-3">Rak 3</option>
                            <option value="rak-4">Rak 4</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Cover Buku <span class="text-primary">(Opsional)</span></label>
                        <input type="file" class="dropify @error('cover') is-invalid @enderror" name="cover"  data-allowed-file-extensions="jpg jpeg png" />
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batak</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- modal create book --}}
@endsection

@push('plugin-js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/modules/dropify/js/dropify.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
@endpush

@push('custom-js')

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

@endpush
