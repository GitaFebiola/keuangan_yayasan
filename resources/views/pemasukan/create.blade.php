@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded-4 p-4">
        <h3 class="mb-4 text-success"><i class="fas fa-arrow-down me-2"></i>Form Input Pemasukan</h3>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 small">
                <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/pemasukan') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label text-success">Bulan</label>
                <input type="month" name="bulan" class="form-control form-control-sm rounded-3 shadow-sm" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-success">Jenis Pemasukan</label>
                <select name="dim_pemasukan_id" class="form-select form-select-sm rounded-3 shadow-sm" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach ($pemasukan as $item)
                        <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label text-success">Unit</label>
                <select name="dim_unit_id" class="form-select form-select-sm rounded-3 shadow-sm" required>
                    @foreach ($unit as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label text-success">Rekening</label>
                <select name="dim_rekening_id" class="form-select form-select-sm rounded-3 shadow-sm" required>
                    @foreach ($rekening as $item)
                        <option value="{{ $item->id }}">{{ $item->bank }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label text-success">Jumlah</label>
                <input type="number" name="jumlah" class="form-control form-control-sm rounded-3 shadow-sm" required>
            </div>

            <div class="d-grid">
                <button class="btn btn-success rounded-pill shadow-sm">
                    <i class="fas fa-save me-2"></i>Simpan Pemasukan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
