<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fact_keuangan', function (Blueprint $table) {
    $table->id();
    $table->date('tanggal');
    $table->foreignId('dim_pemasukan_id')->nullable()->constrained('dim_pemasukan')->nullOnDelete();
    $table->foreignId('dim_pengeluaran_id')->nullable()->constrained('dim_pengeluaran')->nullOnDelete();
    $table->foreignId('dim_unit_id')->constrained('dim_unit')->onDelete('cascade');
    $table->foreignId('dim_rekening_id')->constrained('dim_rekening')->onDelete('cascade');
    $table->decimal('jumlah', 15, 2);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fact_keuangan');
    }
};
