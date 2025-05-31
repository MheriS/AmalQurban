@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kupon Umum</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan saat input data:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kuponumum.update', $kuponumum->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="no_kupon" class="form-label">No Kupon</label>
            <input type="text" name="no_kupon" class="form-control" value="{{ $kuponumum->no_kupon }}" readonly>
        </div>

        <div class="mb-3">
            <label for="wilayah" class="form-label">Wilayah</label>
            <input type="text" name="wilayah" class="form-control" value="{{ $kuponumum->wilayah }}" required>
        </div>

        <div class="mb-3">
            <label for="jatah" class="form-label">Jatah</label>
            <input type="text" name="jatah" class="form-control" value="{{ $kuponumum->jatah }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_daging" class="form-label">Jenis Daging</label>
            <select name="jenis_daging" class="form-control" required>
                <option value="Sapi" {{ $kuponumum->jenis_daging == 'Sapi' ? 'selected' : '' }}>Sapi</option>
                <option value="Kambing" {{ $kuponumum->jenis_daging == 'Kambing' ? 'selected' : '' }}>Kambing</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Belum Scan" {{ $kuponumum->status == 'Belum Scan' ? 'selected' : '' }}>Belum Scan</option>
                <option value="Sudah Scan" {{ $kuponumum->status == 'Sudah Scan' ? 'selected' : '' }}>Sudah Scan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('kuponumum.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection