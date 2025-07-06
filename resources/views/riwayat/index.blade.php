@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded-4 p-4">
        <h3 class="mb-4 text-success"><i class="fas fa-history me-2"></i>Riwayat Keuangan</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle small shadow-sm rounded">
                <thead class="table-success text-center text-dark small">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Unit</th>
                        <th>Rekening</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <span class="badge {{ $item->dim_pemasukan_id ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->dim_pemasukan_id ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                            </td>
                            <td>{{ $item->dim_pemasukan_id 
                                ? optional($item->dimPemasukan)->jenis ?? '-' 
                                : optional($item->dimPengeluaran)->jenis ?? '-' }}
                            </td>
                            <td>{{ optional($item->dimUnit)->nama ?? '-' }}</td>
                            <td>{{ optional($item->dimRekening)->bank ?? '-' }}</td>
                            <td class="text-end">Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data keuangan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
