@extends('layouts.app')

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@section('title', 'Daftar Pengembalian Barang')

@section('content')
    <div class="container animate__animated animate__fadeIn">
        <h2 class="mb-4"><i class="fas fa-undo-alt me-2"></i>Daftar Pengembalian Barang</h2>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Barang</th>
                        <th>Nama Peminjam</th>
                        <th>Jumlah Dikembalikan</th>
                        <th>Tanggal Kembali</th>
                        <th>Kondisi</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengembalians as $pengembalian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($pengembalian->barang)->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                            <td>{{ $pengembalian->nama_peminjam }}</td>
                            <td>{{ $pengembalian->jumlah }}</td>
                            <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y') }}</td>
                            <td>{{ $pengembalian->pengembalian->kondisi_barang ?? '-' }}</td>
                            <td>
                                @if (!empty($pengembalian->pengembalian->catatan))
                                    <button type="button"
                                        class="btn btn-info btn-sm d-flex align-items-center gap-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#catatanModal{{ $pengembalian->id }}">
                                        <i class="fas fa-sticky-note"></i> Lihat
                                    </button>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                @if ($pengembalian->status === 'selesai')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Selesai</span>
                                @elseif ($pengembalian->status === 'pending')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Pending</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($pengembalian->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('pengembalian.setuju', $pengembalian->id) }}"
                                    class="btn btn-success btn-sm me-1" title="Setujui">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                                <a href="{{ route('pengembalian.tolak', $pengembalian->id) }}"
                                    class="btn btn-danger btn-sm me-1" onclick="return confirm('Yakin ingin menolak?')" title="Tolak">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk Catatan -->
    @foreach ($pengembalians as $pengembalian)
        @if (!empty($pengembalian->pengembalian->catatan))
            <div class="modal fade" id="catatanModal{{ $pengembalian->id }}" tabindex="-1" aria-labelledby="catatanModalLabel{{ $pengembalian->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content animate__animated animate__fadeInDown shadow-lg border-0 rounded-3">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title" id="catatanModalLabel{{ $pengembalian->id }}">
                                <i class="fas fa-file-alt me-2"></i>Catatan Pengembalian
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body fs-6">
                            {{ $pengembalian->pengembalian->catatan }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                                <i class="fas fa-times-circle me-1"></i> Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@push('scripts')
    <!-- Bootstrap JS (wajib agar modal berfungsi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
