<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table = 'pegawai';

    protected $guarded = ['created_at', 'updated_at'];

    public function relatedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
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
