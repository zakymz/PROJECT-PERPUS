<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id')->index();
            $table->unsignedBigInteger('anggota_id')->index();
            $table->unsignedBigInteger('buku_id')->index();
            $table->string('no_transaksi');
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_berakhir')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->enum('status', ['pinjam', 'kembali', 'hilang'])->nullable();
            $table->unsignedDecimal('denda', 10, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
            $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
