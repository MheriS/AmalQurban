@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Daftar Kupon Umum</h1>
  </div>

  <div class="section-body">

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahKupon">
      + Tambah Kupon Umum
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalTambahKupon" tabindex="-1" aria-labelledby="modalTambahKuponLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <form action="{{ route('kuponumum.store') }}" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahKuponLabel">Tambah Kupon Umum</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">

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

              <div class="form-group">
                <label>Wilayah <span class="text-danger">*</span></label>
                <select name="wilayah" class="form-control" required>
                  <option value="">-- Pilih --</option>
                  <option value="Desa Bangkal, Rt. 001/001">Desa Bangkal, Rt. 001/001</option>
                  <option value="Desa Bangkal, Rt. 001/002">Desa Bangkal, Rt. 001/002</option>
                  <option value="Desa Bangkal, Rt. 001/003">Desa Bangkal, Rt. 001/003</option>
                  <option value="Desa Bangkal, Rt. 001/004">Desa Bangkal, Rt. 001/004</option>
                </select>
              </div>

              <div class="form-group">
                <label>Jenis Daging <span class="text-danger">*</span></label>
                <select name="jenis_daging" class="form-control" required>
                  <option value="">-- Pilih --</option>
                  <option value="Sapi">Sapi</option>
                  <option value="Kambing">Kambing</option>
                </select>
              </div>

              <div class="form-group">
                <label>Jatah/Jumlah Daging Per-Kupon <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="text" name="jatah" class="form-control" placeholder="Contoh: 2" required>
                  <div class="input-group-append">
                    <span class="input-group-text">KG</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Jumlah Kupon Generate <span class="text-danger">*</span></label>
                <input type="number" name="jumlah_kupon" class="form-control" required>
              </div>

              <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" name="konfirmasi" id="konfirmasi" required>
                <label class="form-check-label" for="konfirmasi">
                  Saya yakin sudah mengisi dengan benar.
                </label>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>No</th>
                <th>No Kupon</th>
                <th>Wilayah</th>
                <th>Jatah</th>
                <th>Jenis Daging</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($kuponumums as $kuponumum)
                <tr>
                  <td>{{ $loop->iteration + ($kuponumums->currentPage() - 1) * $kuponumums->perPage() }}</td>
                  <td>{{ $kuponumum->no_kupon ?? 'N/A' }}</td>
                  <td>{{ $kuponumum->wilayah ?? 'N/A' }}</td>
                  <td>{{ $kuponumum->jatah ?? 'N/A' }}</td>
                  <td>{{ $kuponumum->jenis_daging ?? 'N/A' }}</td>
                  <td>
                    <span class="badge badge-{{ $kuponumum->status == 'Belum Scan' ? 'warning' : 'success' }}">
                      {{ $kuponumum->status }}
                    </span>
                  </td>
                  <td>
                    <a href="{{ route('kuponumum.edit', $kuponumum->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kuponumum.destroy', $kuponumum->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">Belum ada data kupon.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
      <div>
        Menampilkan {{ $kuponumums->firstItem() }} sampai {{ $kuponumums->lastItem() }} dari total {{ $kuponumums->total() }} entri
      </div>
      <div>
        {{ $kuponumums->links('pagination::bootstrap-5') }}
      </div>
    </div>

  </div>
</section>
@endsection