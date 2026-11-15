<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nominal',
        'tanggal',
        'keterangan',
        'bukti_pembayaran',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}