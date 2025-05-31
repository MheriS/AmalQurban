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

    <div class="mb-3">
      <button type="button" class="btn btn-primary btn-icon icon-left" data-toggle="modal" data-target="#modalTambahKupon">
        <i class="fas fa-plus"></i> Tambah Kupon Umum
      </button>
    </div>

    <!-- Tabel Data -->
    <div class="card">
      <div class="card-header">
        <h4>Data Kupon Umum</h4>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped table-hover mb-0">
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
                  <td>{{ $kuponumum->jatah ? $kuponumum->jatah . ' KG' : 'N/A' }}</td>
                  <td>{{ $kuponumum->jenis_daging ?? 'N/A' }}</td>
                  <td>
                    <span class="badge badge-{{ $kuponumum->status == 'Belum Scan' ? 'warning' : 'success' }}">
                      {{ $kuponumum->status }}
                    </span>
                  </td>
                  <td>
                    <a href="{{ route('kuponumum.edit', $kuponumum->id) }}" class="btn btn-sm btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('kuponumum.destroy', $kuponumum->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">
                        <i class="fas fa-trash"></i>
                      </button>
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

    <div class="row mt-3">
      {{-- Info entri di kiri --}}
      <div class="col-md-6 col-12 text-md-left text-center mb-2 mb-md-0">
        Menampilkan {{ $kuponumums->firstItem() }}&ndash;{{ $kuponumums->lastItem() }}
        dari total {{ $kuponumums->total() }} entri
      </div>

      {{-- Pagination di kanan --}}
      <div class="col-md-6 col-12 text-md-right text-center">
        {{-- pakai view bootstrap-4 bawaan agar class <ul> dan <li>-nya pas --}}
        <nav aria-label="Page navigation">
          {{ $kuponumums->links('vendor.pagination.bootstrap-4') }}
        </nav>
      </div>
    </div>

  </div>
</section>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahKupon" tabindex="-1" role="dialog" aria-labelledby="modalTambahKuponLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="{{ route('kuponumum.store') }}" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Tambah Kupon Umum</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              @if ($errors->any())
              <div class="alert alert-danger">
                <strong>Oops!</strong> Ada kesalahan:
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
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection