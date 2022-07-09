@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="{{ asset('assets/modules/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            {{-- row --}}
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Edit Buku</h4>
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
                            <a href="{{ route('buku.edit', $buku->id) }}">Edit Buku {{ $buku->judul }}</a>
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
                                <h6 class="font-weight-bold mb-3">Edit Data Buku {{ $buku->judul }}</h6>
                            </div>

                            <div class="col-md-12">
                                <form action="{{ route('buku.update', $buku->id) }}" method="post" enctype="multipart/form-data"> @csrf @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Judul Buku <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" value="{{ old('judul_buku', $buku->judul) }}" placeholder="Masukan Judul Buku" class="form-control" required id="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">ISBN <span class="text-primary">(Opsional)</span></label>
                                            <input type="text" name="isbn" value="{{ old('isbn', $buku->isbn) }}" placeholder="Masukan ISBN" id="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Pengarang <span class="text-danger">*</span></label>
                                            <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" placeholder="Masukan Pengarang" required id="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Penerbit <span class="text-danger">*</span></label>
                                            <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" placeholder="Masukan Penerbit" required id="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Tahun Terbit <span class="text-danger">*</span></label>
                                            <input type="text" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" placeholder="Masukan Jumlah Buku" required id="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Jumlah Buku <span class="text-danger">*</span></label>
                                            <input type="number" name="jumlah_buku" value="{{ old('jumlah_buku', $buku->jumlah_buku) }}" placeholder="Masukan Jumlah Buku" required id="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Deskripsi <span class="text-danger">*</span></label>
                                            <textarea name="deskripsi" required id="editor" class="form-control" rows="3">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Lokasi Buku <span class="text-danger">*</span></label>
                                            <select name="lokasi" class="form-control" required id="">
                                                <option value="">Pilih Lokasi</option>
                                                <option value="rak-1" {{ $buku->lokasi == 'rak-1' ? 'selected' : '' }}>Rak 1</option>
                                                <option value="rak-2" {{ $buku->lokasi == 'rak-2' ? 'selected' : '' }}>Rak 2</option>
                                                <option value="rak-3" {{ $buku->lokasi == 'rak-3' ? 'selected' : '' }}>Rak 3</option>
                                                <option value="rak-4" {{ $buku->lokasi == 'rak-4' ? 'selected' : '' }}>Rak 4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Cover Buku <span class="text-primary">(Opsional)</span></label>
                                            <input type="file" class="dropify @error('cover') is-invalid @enderror" name="cover"  data-allowed-file-extensions="jpg jpeg png" />
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block">Update Data</button>
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
@endsection

@push('plugin-js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('assets/modules/dropify/js/dropify.min.js') }}"></script>
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
