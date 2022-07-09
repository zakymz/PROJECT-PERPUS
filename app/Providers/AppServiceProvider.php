<?php

namespace App\Providers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::composer('*', function ($view)
        {
            if(Auth::check())
            {
                $peminjaman_jatuh_tempo = Transaction::where('tgl_berakhir', '<=', Carbon::now()->addDays(2))->get();
                if(auth()->user()->role == 'anggota'){
                    $peminjaman_anggota_jatuh_tempo = Transaction::where('anggota_id', auth()->user()->relatedAnggota->id)->where('tgl_berakhir', '<=', Carbon::now()->addDays(2))->get();
                }else{
                    $peminjaman_anggota_jatuh_tempo = [];
                }
                view()->share([
                    'peminjaman_jatuh_tempo' => $peminjaman_jatuh_tempo,
                    'peminjaman_anggota_jatuh_tempo' => $peminjaman_anggota_jatuh_tempo,
                ]);
            }
        });
    }
}
