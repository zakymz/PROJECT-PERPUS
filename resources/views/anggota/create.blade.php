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
                    <h4 class="page-title">Tambah Anggota Perpustakaan</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('anggota.index') }}">Anggota Perpustakaan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('anggota.create') }}">Tambah Anggota Perpustakaan</a>
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
                                <h6 class="font-weight-bold mb-3">Tambah Anggota</h6>
                            </div>

                            <div class="col-md-12">
                                <form action="{{ route('anggota.store') }}" method="post" enctype="multipart/form-data"> @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Nama <span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukan Nama Anggota" class="form-control" required id="">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukan Email Anggota" class="form-control" required id="">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="">Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" value="12345678" placeholder="Masukan Password" class="form-control" required id="">
                                            <span class="font-10 text-primary">Default : 12345678</span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="">No HP <span class="text-danger">*</span></label>
                                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukan No HP Anggota" class="form-control" required id="">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                            <br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="laki" name="jk" value="Laki-laki"
                                                    class="custom-control-input " checked>
                                                <label class="custom-control-label" for="laki">Laki-laki</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="perempuan" name="jk" value="Perempuan"
                                                    class="custom-control-input ">
                                                <label class="custom-control-label" for="perempuan">Perempuan</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" placeholder="Masukan Tgl Lahir" class="form-control" required id="">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="">Alamat <span class="text-danger">*</span></label>
                                            <textarea name="alamat" class="form-control" id="" required rows="3">{{ old('alamat') }}</textarea>
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
