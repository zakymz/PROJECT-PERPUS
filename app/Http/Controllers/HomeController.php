<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Pegawai;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        if(auth()->user()->role != 'anggota') {
            $pinjam     = Transaction::where('status', 'pinjam')->count();
        } else {
            $pinjam     = Transaction::where('status', 'pinjam')->where('anggota_id', auth()->user()->relatedAnggota->id)->count();
        }

        $buku       = Buku::count();
        $anggota    = Anggota::count();
        $pegawai    = Pegawai::count();

        // Diagram Peminjaman Buku
        $januari_pinjam          = Transaction::whereMonth('tgl_pinjam','01')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $februari_pinjam         = Transaction::whereMonth('tgl_pinjam','02')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $maret_pinjam            = Transaction::whereMonth('tgl_pinjam','03')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $april_pinjam            = Transaction::whereMonth('tgl_pinjam','04')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $mei_pinjam              = Transaction::whereMonth('tgl_pinjam','05')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $juni_pinjam             = Transaction::whereMonth('tgl_pinjam','06')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $juli_pinjam             = Transaction::whereMonth('tgl_pinjam','07')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $agustus_pinjam          = Transaction::whereMonth('tgl_pinjam','08')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $september_pinjam        = Transaction::whereMonth('tgl_pinjam','09')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $oktober_pinjam          = Transaction::whereMonth('tgl_pinjam','10')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $november_pinjam         = Transaction::whereMonth('tgl_pinjam','11')->whereYear('tgl_pinjam', Carbon::now()->year)->count();
        $desember_pinjam         = Transaction::whereMonth('tgl_pinjam','12')->whereYear('tgl_pinjam', Carbon::now()->year)->count();

        return view('home', compact('pinjam', 'buku', 'anggota', 'pegawai', 'januari_pinjam', 'februari_pinjam', 'maret_pinjam', 'april_pinjam', 'mei_pinjam', 'juni_pinjam', 'juli_pinjam', 'agustus_pinjam', 'september_pinjam', 'oktober_pinjam', 'november_pinjam', 'desember_pinjam'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
