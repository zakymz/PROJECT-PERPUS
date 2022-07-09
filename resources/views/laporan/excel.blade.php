<table class="table table-striped table-bordered dt-responsive nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th style="font-weight: bold;">No</th>
            <th style="font-weight: bold;">Pegawai</th>
            <th style="font-weight: bold;">Tgl Pinjam</th>
            <th style="font-weight: bold;">Tgl Akhir Pinjam</th>
            <th style="font-weight: bold;">Anggota</th>
            <th style="font-weight: bold;">Buku</th>
            <th style="font-weight: bold;">Tgl Kembali</th>
            <th style="font-weight: bold;">Denda</th>
            <th style="font-weight: bold;">Status</th>
            <th style="font-weight: bold;">Keterangan</th>
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
                    Rp. {{ formatUang($item->denda) }}
                </td>
                
                    @if ($item->status == 'pinjam')
                    <td style="background-color: #30419b; color: #ffffff">Dipinjam</td>
                    @elseif ($item->status == 'kembali')
                    <td style="background-color: #02c58d; color: #ffffff">Dikembalikan</td>
                    @else
                    <td style="background-color: #fc5454; color: #ffffff">Hilang/Tidak Ada</td>
                    @endif
                
                <td>{{ $item->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>