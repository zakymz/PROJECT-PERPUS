<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Throwable;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
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
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        
        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        return view('laporan.index', compact('transactions'));
    }

    public function export(Request $request) 
    {
        try {
            $start  = $request->tgl_mulai;
            $end    = $request->tgl_akhir;
            $status = $request->status;

            $excel = Excel::download(new TransactionExport($start, $end, $status), 'Report '. TanggalID('j M Y', $start) .' - '. TanggalID('j M Y', $end) .'.xlsx');
            ob_end_clean();
            return $excel;
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh laporan');
        }
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
