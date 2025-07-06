@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-success fw-semibold"><i class="fas fa-chart-line me-2"></i>Ringkasan Keuangan Yayasan</h3>

    <div class="row">
        <!-- Grafik 1: Pemasukan per Unit -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="text-center">Pemasukan per Unit</h5>
                    <canvas id="unitChart" style="max-height: 250px; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 2: Pengeluaran per Bulan -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="text-center">Pengeluaran per Bulan</h5>
                    <canvas id="bulanChart" style="max-height: 250px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Grafik 3: Pemasukan per Kategori -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="text-center">Pemasukan per Kategori</h5>
                    <canvas id="kategoriPemasukanChart" style="max-height: 250px; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 6: Total Aktivitas per Rekening -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Total Aktivitas per Rekening</h5>
                    <canvas id="rekeningChart" style="max-height: 250px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik 4 & 5: Ukuran Panjang Full -->
    <div class="row">
        <!-- Grafik 4: Selisih Pemasukan - Pengeluaran -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Selisih Pemasukan - Pengeluaran</h5>
                    <canvas id="areaChart" style="max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik 5: Pengeluaran per Kategori -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Pengeluaran per Kategori</h5>
                    <canvas id="kategoriPengeluaranChart" style="max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('unitChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($pemasukanByUnit->pluck('dimUnit.nama')) !!},
            datasets: [{
                data: {!! json_encode($pemasukanByUnit->pluck('total')) !!},
                backgroundColor: ['#4ade80', '#60a5fa', '#facc15']
            }]
        }
    });

    new Chart(document.getElementById('bulanChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(
                $pengeluaranByBulan->pluck('bulan')->map(fn($b) =>
                    \Carbon\Carbon::createFromFormat('Y-m', $b)->translatedFormat('F Y')
                )
            ) !!},
            datasets: [{
                label: 'Total Pengeluaran',
                data: {!! json_encode($pengeluaranByBulan->pluck('total')) !!},
                backgroundColor: '#f87171'
            }]
        }
    });

    new Chart(document.getElementById('kategoriPemasukanChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($pemasukanPerKategori->pluck('dimPemasukan.jenis')) !!},
            datasets: [{
                data: {!! json_encode($pemasukanPerKategori->pluck('total')) !!},
                backgroundColor: ['#93c5fd', '#fde68a', '#86efac']
            }]
        }
    });

    new Chart(document.getElementById('areaChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($selisih->pluck('bulan')->map(fn($b) =>
                \Carbon\Carbon::createFromFormat('Y-m', $b)->translatedFormat('F Y')
            )) !!},
            datasets: [{
                label: 'Selisih',
                data: {!! json_encode($selisih->pluck('selisih')) !!},
                backgroundColor: 'rgba(96, 165, 250, 0.3)',
                borderColor: '#60a5fa',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('kategoriPengeluaranChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($pengeluaranPerKategori->pluck('dimPengeluaran.jenis')) !!},
            datasets: [{
                label: 'Pengeluaran per Kategori',
                data: {!! json_encode($pengeluaranPerKategori->pluck('total')) !!},
                backgroundColor: '#fca5a5'
            }]
        },
        options: {
            indexAxis: 'y'
        }
    });

    new Chart(document.getElementById('rekeningChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($rekeningStat->pluck('dimRekening.bank')) !!},
            datasets: [{
                data: {!! json_encode($rekeningStat->pluck('total')) !!},
                backgroundColor: ['#a78bfa', '#34d399', '#f472b6']
            }]
        }
    });
</script>
@endsection
