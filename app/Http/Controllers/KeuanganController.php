<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DimPemasukan;
use App\Models\DimPengeluaran;
use App\Models\DimUnit;
use App\Models\DimRekening;
use App\Models\FactKeuangan;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    // ==============================
    // DASHBOARD
    // ==============================
    public function dashboard()
    {
        // Pie - Pemasukan per Unit
        $pemasukanByUnit = FactKeuangan::with('dimUnit')
            ->whereNotNull('dim_pemasukan_id')
            ->selectRaw('dim_unit_id, SUM(jumlah) as total')
            ->groupBy('dim_unit_id')
            ->get();

        // Bar - Pengeluaran per Bulan
        $pengeluaranByBulan = FactKeuangan::whereNotNull('dim_pengeluaran_id')
            ->selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan, SUM(jumlah) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Doughnut - Pemasukan per Kategori
        $pemasukanPerKategori = FactKeuangan::with('dimPemasukan')
            ->whereNotNull('dim_pemasukan_id')
            ->selectRaw('dim_pemasukan_id, SUM(jumlah) as total')
            ->groupBy('dim_pemasukan_id')
            ->get();

        // Area Line - Selisih per Bulan
        $selisih = FactKeuangan::selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan")
            ->selectRaw("
                SUM(CASE WHEN dim_pemasukan_id IS NOT NULL THEN jumlah ELSE 0 END) -
                SUM(CASE WHEN dim_pengeluaran_id IS NOT NULL THEN jumlah ELSE 0 END) as selisih
            ")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Horizontal Bar - Pengeluaran per Kategori
        $pengeluaranPerKategori = FactKeuangan::with('dimPengeluaran')
            ->whereNotNull('dim_pengeluaran_id')
            ->selectRaw('dim_pengeluaran_id, SUM(jumlah) as total')
            ->groupBy('dim_pengeluaran_id')
            ->get();

        // Pie - Aktivitas per Rekening
        $rekeningStat = FactKeuangan::with('dimRekening')
            ->whereNotNull('dim_rekening_id')
            ->selectRaw('dim_rekening_id, SUM(jumlah) as total')
            ->groupBy('dim_rekening_id')
            ->get();

        return view('dashboard.index', compact(
            'pemasukanByUnit',
            'pengeluaranByBulan',
            'pemasukanPerKategori',
            'selisih',
            'pengeluaranPerKategori',
            'rekeningStat'
        ));
    }

    // ==============================
    // FORM INPUT PEMASUKAN
    // ==============================
    public function createPemasukan()
    {
        return view('pemasukan.create', [
            'pemasukan' => DimPemasukan::all(),
            'unit' => DimUnit::all(),
            'rekening' => DimRekening::all(),
        ]);
    }

    public function storePemasukan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m',
            'dim_pemasukan_id' => 'required|exists:dim_pemasukan,id',
            'dim_unit_id' => 'required|exists:dim_unit,id',
            'dim_rekening_id' => 'required|exists:dim_rekening,id',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $tanggal = Carbon::createFromFormat('Y-m', $request->bulan)->startOfMonth();

        $cek = FactKeuangan::whereMonth('tanggal', $tanggal->month)
            ->whereYear('tanggal', $tanggal->year)
            ->where('dim_pemasukan_id', $request->dim_pemasukan_id)
            ->where('dim_unit_id', $request->dim_unit_id)
            ->exists();

        if ($cek) {
            return back()->withErrors(['msg' => 'Jenis pemasukan ini sudah diinput untuk unit tersebut pada bulan ini']);
        }

        FactKeuangan::create([
            'tanggal' => $tanggal,
            'dim_pemasukan_id' => $request->dim_pemasukan_id,
            'dim_unit_id' => $request->dim_unit_id,
            'dim_rekening_id' => $request->dim_rekening_id,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('riwayat')->with('success', 'Pemasukan berhasil disimpan');
    }

    // ==============================
    // FORM INPUT PENGELUARAN
    // ==============================
    public function createPengeluaran()
    {
        return view('pengeluaran.create', [
            'pengeluaran' => DimPengeluaran::all(),
            'unit' => DimUnit::all(),
            'rekening' => DimRekening::all(),
        ]);
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m',
            'dim_pengeluaran_id' => 'required|exists:dim_pengeluaran,id',
            'dim_unit_id' => 'required|exists:dim_unit,id',
            'dim_rekening_id' => 'nullable|exists:dim_rekening,id',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $tanggal = Carbon::createFromFormat('Y-m', $request->bulan)->startOfMonth();

        $cek = FactKeuangan::whereMonth('tanggal', $tanggal->month)
            ->whereYear('tanggal', $tanggal->year)
            ->where('dim_pengeluaran_id', $request->dim_pengeluaran_id)
            ->where('dim_unit_id', $request->dim_unit_id)
            ->exists();

        if ($cek) {
            return back()->withErrors(['msg' => 'Jenis pengeluaran ini sudah diinput untuk unit tersebut pada bulan ini']);
        }

        FactKeuangan::create([
            'tanggal' => $tanggal,
            'dim_pengeluaran_id' => $request->dim_pengeluaran_id,
            'dim_unit_id' => $request->dim_unit_id,
            'dim_rekening_id' => $request->dim_rekening_id ?: null,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('riwayat')->with('success', 'Pengeluaran berhasil disimpan');
    }

    // ==============================
    // RIWAYAT
    // ==============================
    public function riwayat()
    {
        $riwayat = FactKeuangan::with(['dimPemasukan', 'dimPengeluaran', 'dimUnit', 'dimRekening'])
            ->orderBy('tanggal', 'desc')->get();

        return view('riwayat.index', compact('riwayat'));
    }
}
