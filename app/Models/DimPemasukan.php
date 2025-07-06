<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimPemasukan extends Model
{
    protected $table = 'dim_pemasukan';

    protected $fillable = ['nama']; // atau kolom lain yang kamu buat
}
