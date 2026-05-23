<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;

    protected $table = 'gaji_karyawans';

    protected $fillable = [
        'karyawan_id',
        'gaji_pokok',
        'lembur',
        'pinjaman',
        'total_penghasilan',
        'total_potongan',
        'gaji_bersih',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
