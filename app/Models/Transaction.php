<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function relatedPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function relatedAnggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function relatedBuku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function relatedCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function relatedUpdatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
