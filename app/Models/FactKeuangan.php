<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactKeuangan extends Model
{
    protected $table = 'fact_keuangan';

    protected $fillable = [
        'tanggal',
        'dim_pemasukan_id',
        'dim_pengeluaran_id',
        'dim_unit_id',
        'dim_rekening_id',
        'jumlah'
    ];

    // Relasi ke tabel dimensi
    public function dimPemasukan()
    {
        return $this->belongsTo(DimPemasukan::class, 'dim_pemasukan_id');
    }

    public function dimPengeluaran()
    {
        return $this->belongsTo(DimPengeluaran::class, 'dim_pengeluaran_id');
    }

    public function dimUnit()
    {
        return $this->belongsTo(DimUnit::class, 'dim_unit_id');
    }

    public function dimRekening()
    {
        return $this->belongsTo(DimRekening::class, 'dim_rekening_id');
    }
}
