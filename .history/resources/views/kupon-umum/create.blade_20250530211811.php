@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Kupon Umum</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan saat input data:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kuponumum.store') }}" method="POST">
        @csrf

        {{-- Wilayah --}}
        <div class="mb-3">
            <label for="wilayah" class="form-label">Wilayah <span class="text-danger">*</span></label>
            <select name="wilayah" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Wilayah 1">Wilayah 1</option>
                <option value="Wilayah 2">Wilayah 2</option>
                {{-- Tambahkan opsi lainnya sesuai kebutuhan --}}
            </select>
        </div>

        {{-- Jenis Daging --}}
        <div class="mb-3">
            <label for="jenis_daging" class="form-label">Jenis Daging <span class="text-danger">*</span></label>
            <select name="jenis_daging" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Sapi">Sapi</option>
                <option value="Kambing">Kambing</option>
            </select>
        </div>

        {{-- Jatah Daging --}}
        <div class="mb-3">
            <label for="jatah" class="form-label">Jatah/Jumlah Daging Per-Kupon <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="jatah" class="form-control" placeholder="Ketik Jatah. c/ 2" required>
                <span class="input-group-text">KG</span>
            </div>
        </div>

        {{-- Jumlah Kupon --}}
        <div class="mb-3">
            <label for="jumlah_kupon" class="form-label">Jumlah Kupon Generate <span class="text-danger">*</span></label>
            <input type="number" name="jumlah_kupon" class="form-control" placeholder="Ketik Jumlah Kupon Generate" required>
        </div>

        {{-- Checkbox Konfirmasi --}}
        <div class="form-check mb-3">
            <input type="checkbox" name="konfirmasi" class="form-check-input" id="konfirmasi" required>
            <label class="form-check-label" for="konfirmasi">
                Saya yakin sudah mengisi dengan benar.
            </label>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('kuponumum.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection