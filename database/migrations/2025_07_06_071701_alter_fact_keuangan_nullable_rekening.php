<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFactKeuanganNullableRekening extends Migration
{
    public function up()
    {
        Schema::table('fact_keuangan', function (Blueprint $table) {
            $table->unsignedBigInteger('dim_rekening_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('fact_keuangan', function (Blueprint $table) {
            $table->unsignedBigInteger('dim_rekening_id')->nullable(false)->change();
        });
    }
}

