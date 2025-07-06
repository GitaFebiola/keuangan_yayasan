<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimRekening extends Model
{
   protected $table = 'dim_rekening'; // ← ini kunci pentingnya!
    protected $fillable = ['nama'];
}
