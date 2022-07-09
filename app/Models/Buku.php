<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table = 'buku';

    protected $guarded = ['created_at', 'updated_at'];

    public function getCoverAttribute()
    {
        $image = $this->attributes['cover'];
        if($image != null) {
            return asset('storage/buku/' . $image);
        }else{
            return null;
        }
    }

    public function relatedPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
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
