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
                    <h4 class="page-title">Detail Peminjaman Buku</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('transaction.index') }}">Peminjaman Buku</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('transaction.show', $transaction->id) }}">Detail Peminjaman Buku</a>
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
                        <h4 class="mt-0 header-title mb-4">Detail Pinjaman {{ $transaction->relatedAnggota->relatedUser->name }}</h4>
                        <div class="row">
        
                            <div class="col-md-6">
                                <h5 class="font-weight-bold font-14">Data Buku</h5>
                                <hr/>
                                <ul class="list-unstyled">
                                    <li class="media">
                                        <a data-fancybox="gallery" href="{{ $transaction->relatedBuku->cover ?? url('assets/images/default-cover.png')  }}">
                                            <img src="{{ $transaction->relatedBuku->cover ?? url('assets/images/default-cover.png') }}" style="width: 90px;" alt="">
                                        </a>
                                      <div class="media-body ml-2">
                                        <h5 class="mt-0 mb-1">{{ $transaction->relatedBuku->judul }}</h5>
                                        <span>Pengarang : {{ $transaction->relatedBuku->pengarang }}</span> <br/>
                                        <span>Penerbit : {{ $transaction->relatedBuku->penerbit }}</span> <br/>
                                        <span>Tahun Terbit : {{ $transaction->relatedBuku->tahun_terbit }}</span> <br/>
                                        @if ($transaction->status == 'pinjam')
                                                    <span class="badge badge-warning">Dipinjam</span>
                                                @elseif ($transaction->status == 'kembali')
                                                    <span class="badge badge-success">Dikembalikan</span>
                                                @else
                                                    <span class="badge badge-danger">Hilang</span>
                                                @endif
                                      </div>
                                    </li>
                                </ul>
                                <p>{!! $transaction->relatedBuku->deskripsi !!}</p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="font-weight-bold font-14">Data Anggota</h5>
                                <a href="https://wa.me/{{ $transaction->relatedAnggota->no_hp }}" target="_blank" class="btn btn-success float-right btn-sm" style="margin-top: -30px"><i class="fa-brands fa-whatsapp"></i> Hubungi Whatsapp</a>
                                <hr/>
                                <table class="mt-4" width="100%;">
                                    <tr>
                                        <th>No Anggota</th>
                                        <td class="text-right">{{ $transaction->relatedAnggota->no_anggota }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td class="text-right">{{ $transaction->relatedAnggota->relatedUser->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td class="text-right">{{ $transaction->relatedAnggota->relatedUser->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>No HP</th>
                                        <td class="text-right">{{ $transaction->relatedAnggota->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td class="text-right">{{ $transaction->relatedAnggota->jk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td class="text-right">{{ $transaction->relatedAnggota->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pinjam</th>
                                        <td class="text-right text-primary">{{ TanggalID('j M Y', $transaction->tgl_pinjam) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Berakhir</th>
                                        <td class="text-right text-danger">{{ TanggalID('j M Y', $transaction->tgl_berakhir) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Kembali</th>
                                        <td class="text-right">
                                            @if ($transaction->status != 'hilang')
                                                @if ($transaction->tgl_kembali != null)
                                                <span class="text-success">{{ TanggalID('j M Y', $transaction->tgl_kembali) }}</span>
                                                @else
                                                <span class="badge badge-danger">Belum Di Kembalikan</span>
                                                @endif
                                            @else
                                                <span class="badge badge-danger">Buku Hilang</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Denda</th>
                                        <td class="text-right">Rp. {{ formatUang($transaction->denda) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{{ $transaction->keterangan }}</td>
                                    </tr>
                                </table>

                                @if ($transaction->status != 'hilang')
                                    @if ($transaction->status == 'pinjam')
                                        <div class="mt-3">
                                            <a href="#modal-buku-tidak-ada" data-toggle="modal" class="btn btn-outline-danger"><i class="fa-light fa-circle-xmark"></i> Buku Hilang / Tidak Ada</a>
                                            <a href="#modal-kembalikan-buku" data-toggle="modal" class="btn btn-primary float-right"><i class="fa-solid fa-check-double"></i> Kembalikan Buku</a>
                                        </div>
                                    @else
                                        <i class="fa-light fa-badge-check text-success float-right" style="font-size: 80px;"></i>
                                    @endif
                                @endif
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

            </div>
        </div>

    </div>

</div>
<!-- content -->

{{-- modal kembalikan buku --}}
<div class="modal fade" id="modal-kembalikan-buku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pengembalian Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('transaction.kembalikan_buku', $transaction->id) }}" method="post"> @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Tanggal Kembali <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_kembali" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Denda</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Rp. </div>
                            </div>
                            <input type="text" name="denda" class="form-control" id="rupiah" placeholder="">
                        </div>
                        <span class="text-primary font-10">Tidak wajib di isi.</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kembalikan Buku</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- modal kembalikan buku --}}

{{-- modal buku hilang / tidak ada --}}
<div class="modal fade" id="modal-buku-tidak-ada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buku Hilang / Tidak Ada</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('transaction.buku_tidak_ada', $transaction->id) }}" method="post"> @csrf
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="">Denda</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" name="denda" class="form-control" id="rupiah2" placeholder="">
                    </div>
                    <span class="text-primary font-10">Tidak wajib di isi.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- modal buku hilang / tidak ada --}}
@endsection

@push('plugin-js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endpush

@push('custom-js')

    <script>
        var rupiah = document.getElementById('rupiah');
        $(rupiah).on('input', function (event) {
            this.value = this.value.replace(/[^0-9.]/g, '');
        });
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
    </script>

    <script>
        var rupiah2 = document.getElementById('rupiah2');
        $(rupiah2).on('input', function (event) {
            this.value = this.value.replace(/[^0-9.]/g, '');
        });
        rupiah2.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah2.value = formatRupiah(this.value, 'Rp. ');
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah2     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah2 += separator + ribuan.join('.');
            }
            rupiah2 = split[1] != undefined ? rupiah2 + '.' + split[1] : rupiah2;
            return prefix == undefined ? rupiah2 : (rupiah2 ? '' + rupiah2 : '');
        }
    </script>

@endpush

