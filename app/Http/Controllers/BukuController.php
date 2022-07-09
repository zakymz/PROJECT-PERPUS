<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Throwable;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->path = storage_path('app/public/buku');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $bukus = Buku::orderBy('created_at', 'desc')->get();
        return view('buku.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'judul'         => 'required',
            'pengarang'     => 'required',
            'penerbit'      => 'required',
            'tahun_terbit'  => 'required',
            'jumlah_buku'   => 'required',
            'deskripsi'     => 'required',
        ]);

        try {
            // generate code
            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            if($request->file('cover') == '') {
                $cover = null;
            } else {
                $image = $request->file('cover');
                $cover = $image->hashName();
                $image              = Image::make($image)->save($this->path . '/' .$cover, 50);
            }

            $kode_buku = 'BK-'.Str::upper($random);

            $buku = new Buku();
            $buku->pegawai_id   = auth()->user()->relatedPegawai->id;
            $buku->kode_buku    = $kode_buku;
            $buku->judul        = $validated['judul'];
            $buku->isbn         = $request->isbn;
            $buku->pengarang    = $validated['pengarang'];
            $buku->penerbit     = $validated['penerbit'];
            $buku->tahun_terbit = $validated['tahun_terbit'];
            $buku->jumlah_buku  = $validated['jumlah_buku'];
            $buku->deskripsi    = $validated['deskripsi'];
            $buku->cover        = $cover;
            $buku->lokasi       = $request->lokasi;
            $buku->created_by   = auth()->user()->id;
            $buku->save();

            $notif = [
                'message' => 'Buku berhasil ditambahkan . Judul Buku '. $validated['judul'],
                'title'    => 'Berhasil'
            ];

            return redirect()->route('buku.index')->with($notif);

        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $buku = Buku::findOrFail($id);

        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $buku = Buku::find($id);

        return view('buku.edit', compact('buku'));
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
        $validated = $request->validate([
            'judul'         => 'required',
            'pengarang'     => 'required',
            'penerbit'      => 'required',
            'tahun_terbit'  => 'required',
            'jumlah_buku'   => 'required',
            'deskripsi'     => 'required',
        ]);

        try {

            $buku = Buku::find($id);
            if($request->file('cover') == '') {
                $buku->pegawai_id   = auth()->user()->relatedPegawai->id;
                $buku->judul        = $validated['judul'];
                $buku->isbn         = $request->isbn;
                $buku->pengarang    = $validated['pengarang'];
                $buku->penerbit     = $validated['penerbit'];
                $buku->tahun_terbit = $validated['tahun_terbit'];
                $buku->jumlah_buku  = $validated['jumlah_buku'];
                $buku->deskripsi    = $validated['deskripsi'];
                $buku->lokasi       = $request->lokasi;
                $buku->created_by   = auth()->user()->id;
                $buku->save();
            } else {

                Storage::disk('local')->delete('public/buku/'.basename($buku->service_icon));

                $image = $request->file('cover');
                $cover = $image->hashName();
                $image = Image::make($image)->save($this->path . '/' .$cover, 50);

                $buku->pegawai_id   = auth()->user()->relatedPegawai->id;
                $buku->judul        = $validated['judul'];
                $buku->isbn         = $request->isbn;
                $buku->pengarang    = $validated['pengarang'];
                $buku->penerbit     = $validated['penerbit'];
                $buku->tahun_terbit = $validated['tahun_terbit'];
                $buku->jumlah_buku  = $validated['jumlah_buku'];
                $buku->deskripsi    = $validated['deskripsi'];
                $buku->cover        = $cover;
                $buku->lokasi       = $request->lokasi;
                $buku->created_by   = auth()->user()->id;
                $buku->save();
            }

            $notif = [
                'message' => 'Buku berhasil diupdate . Judul Buku '. $validated['judul'],
                'title'    => 'Berhasil'
            ];

            return redirect()->route('buku.index')->with($notif);

        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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

    // delete
    public function delete($id)
    {
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        try {
            $buku = Buku::find($id);
            $buku->delete();

            $notif = [
                'message' => 'Buku berhasil dihapus . Judul Buku '. $buku->judul,
                'title'    => 'Berhasil'
            ];

            return redirect()->route('buku.index')->with($notif);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
