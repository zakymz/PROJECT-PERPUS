<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromView, ShouldAutoSize
{
    protected $start;
    protected $end;
    protected $status;

    function __construct($start, $end, $status)
    {
        $this->start = $start;
        $this->end = $end;
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        if($this->status == 'all') {
            $transactions = Transaction::whereBetween('tgl_pinjam', [$this->start, $this->end])->orderBy('tgl_pinjam', 'asc')->get();
        } else {
            $transactions = Transaction::whereBetween('tgl_pinjam', [$this->start, $this->end])->where('status', $this->status)->orderBy('tgl_pinjam', 'asc')->get();
        }

        return view('laporan.excel', compact('transactions'));
    }
}
