<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(50);

        return view('peminjaman.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota    = Anggota::orderBy('created_at', 'desc')->get();
        $buku       = Buku::orderBy('created_at', 'desc')->get();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id'    => 'required',
            'buku_id'       => 'required',
            'tgl_pinjam'    => 'required',
            'tgl_kembali'   => 'required',
            'keterangan'    => 'required',
        ]);

        try {
            // generate code
            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $no_transaksi = 'PMJ-'.Str::upper($random);

            $transaction                = new Transaction();
            $transaction->pegawai_id    = auth()->user()->relatedPegawai->id;
            $transaction->anggota_id    = $validated['anggota_id'];
            $transaction->buku_id       = $validated['buku_id'];
            $transaction->no_transaksi  = $no_transaksi;
            $transaction->tgl_pinjam    = $validated['tgl_pinjam'];
            $transaction->tgl_berakhir   = $validated['tgl_kembali'];
            $transaction->keterangan    = $validated['keterangan'];
            $transaction->status        = 'pinjam';
            $transaction->created_by    = auth()->user()->id;
            $transaction->save();

            // update status buku
            $buku               = Buku::find($validated['buku_id']);
            $buku->jumlah_buku  = $buku->jumlah_buku - 1;
            $buku->updated_by   = auth()->user()->id;
            $buku->save();

            $notif = [
                'message'   => 'Data berhasil ditambahkan',
                'title'     => 'Berhasil',
            ];

            return redirect()->route('transaction.index')->with($notif);
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan data peminjaman' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        return view('peminjaman.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function kembalikanBuku(Request $request, $id) 
    {
        $validated = $request->validate([
            'tgl_kembali'   => 'required',
        ]);

        try{
            if($request->denda != '') {
                $denda = str_replace('.', '', $request->denda);
            } else {
                $denda = 0;
            }

            $transaction = Transaction::find($id);
            $transaction->tgl_kembali = $validated['tgl_kembali'];
            $transaction->status = 'kembali';
            $transaction->denda = $denda;
            $transaction->updated_by = auth()->user()->id;
            $transaction->save();

            // update status buku
            $buku               = Buku::find($transaction->buku_id);
            $buku->jumlah_buku  = $buku->jumlah_buku + 1;
            $buku->updated_by   = auth()->user()->id;
            $buku->save();

            $notif = [
                'message'   => 'Buku Berhasil Di Kembalikan. Judul ' . $buku->judul,
                'title'     => 'Berhasil',
            ];

            return redirect()->route('transaction.show', $transaction->id)->with($notif);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data peminjaman' . $e->getMessage());
        }
    }

    public function bukuTidakAda(Request $request, $id)
    {
        try{
            $denda = str_replace('.', '', $request->denda);
            $transaction = Transaction::find($id);
            $transaction->status = 'hilang';
            $transaction->denda = $denda;
            $transaction->updated_by = auth()->user()->id;
            $transaction->save();

            // update status buku
            $buku               = Buku::find($transaction->buku_id);
            $buku->jumlah_buku  = $buku->jumlah_buku + 1;
            $buku->updated_by   = auth()->user()->id;
            $buku->save();

            $notif = [
                'message'   => 'Perubahan Berhasil Di Simpan. Judul ' . $buku->judul,
                'title'     => 'Berhasil',
            ];

            return redirect()->route('transaction.show', $transaction->id)->with($notif);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data peminjaman' . $e->getMessage());
        }
    }
}
