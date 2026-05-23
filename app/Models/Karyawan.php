<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Jabatan;
use App\Models\GajiKaryawan;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'nik',
        'no_telp',
        'email',
    ];

    protected $casts = [
        'jabatan' => Jabatan::class,
    ];

    public function gajiKaryawans()
    {
        return $this->hasMany(GajiKaryawan::class);
    }
}
