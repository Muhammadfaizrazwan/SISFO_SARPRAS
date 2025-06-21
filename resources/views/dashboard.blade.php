@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-end align-items-center gap-2 mb-4">

        <!-- Notifikasi -->
        <div class="dropdown me-2">
            <button id="notifButton" class="btn btn-outline-primary d-flex align-items-center justify-content-center p-0 position-relative"
                type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifikasi"
                style="width:48px; height:48px;">
                <i class="fas fa-bell" style="font-size: 1.6rem; color: #1976d2;"></i>
                <span id="notifCount"
                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                      style="font-size: 0.95rem; min-width: 22px; height: 22px; line-height: 22px; display:none;">
                    0
                </span>
            </button>
            <ul id="notifList" class="dropdown-menu dropdown-menu-end" style="width: 320px; max-height: 300px; overflow-y: auto;">
                <li><span class="dropdown-item-text text-muted">Memuat notifikasi...</span></li>
            </ul>
        </div>

        <!-- Profile -->
        <div class="dropdown">
            <button class="btn btn-white border d-flex align-items-center px-3 py-2"
                    type="button"
                    id="profileDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="height:48px; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.03);">
                <i class="fas fa-user" style="font-size: 1.5rem; color: #222;"></i>
                <span class="mx-2 fw-semibold" style="font-size:1.1rem;">{{ Auth::user()->name ?? 'Profil' }}</span>
                <i class="fas fa-chevron-down" style="font-size: 1rem; color: #888;"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li>
                    <span class="dropdown-item-text">
                        <i class="fas fa-envelope me-2"></i>
                        <strong>{{ Auth::user()->email ?? '-' }}</strong>
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <!-- Tombol trigger modal logout -->
                    <button class="dropdown-item text-danger" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="logoutModalLabel"><i class="fas fa-sign-out-alt me-2"></i>Konfirmasi Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin logout?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <h3 class="mb-4">Dashboard Admin</h3>

            <div id="toastContainer" style="position: fixed; top: 1rem; right: 1rem; z-index: 1055; max-width: 320px;"></div>

            <!-- Card Pengguna -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card text-bg-warning shadow-sm h-100 border-0 hover-zoom">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3"><i class="fas fa-users fa-3x"></i></div>
                        <div>
                            <h5 class="card-title">Pengguna</h5>
                            <p class="card-text fs-4 fw-bold">{{ $totalPengguna }}</p>
                            <a href="{{ route('pengguna.index') }}" class="btn btn-light btn-sm">Lihat Pengguna</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Barang -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card text-bg-danger shadow-sm h-100 border-0 hover-zoom">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3"><i class="fas fa-boxes fa-3x"></i></div>
                        <div>
                            <h5 class="card-title">Total Barang</h5>
                            <p class="card-text fs-4 fw-bold">{{ $totalBarang }}</p>
                            <a href="{{ route('barang.index') }}" class="btn btn-light btn-sm">Lihat Barang</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Peminjaman -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card text-bg-primary shadow-sm h-100 border-0 hover-zoom">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3"><i class="fas fa-handshake fa-3x"></i></div>
                        <div>
                            <h5 class="card-title">Peminjaman</h5>
                            <p class="card-text fs-4 fw-bold">{{ $totalPeminjaman }}</p>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-light btn-sm">Lihat Peminjaman</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas -->
        <div class="row mt-5">
            <h3 class="mb-4">Aktivitas</h3>

            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body" style="height: 360px;">
                        <canvas id="peminjamanChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Peminjaman Terbaru -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white"><h5 class="mb-0">Peminjaman Terbaru</h5></div>
                    <ul class="list-group list-group-flush">
                        @forelse($peminjamanTerbaru as $pinjam)
                            <li class="list-group-item">
                                <strong>{{ $pinjam->nama_peminjam ?? 'Nama Tidak Diketahui' }}</strong>
                            </li>
                        @empty
                            <li class="list-group-item">Tidak ada data peminjaman terbaru.</li>
                        @endforelse
                    </ul>
                </div>
                <!-- Barang Terbaru -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-danger text-white"><h5 class="mb-0">Barang Terbaru</h5></div>
                    <ul class="list-group list-group-flush">
                        @forelse($barangTerbaru as $barang)
                            <li class="list-group-item">{{ $barang->nama_barang ?? 'Nama Barang Tidak Diketahui' }}</li>
                        @empty
                            <li class="list-group-item">Tidak ada data barang terbaru.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js & Day.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/relativeTime.js"></script>
    <script>
        dayjs.extend(dayjs_plugin_relativeTime);

        const ctx = document.getElementById('peminjamanChart').getContext('2d');
        const peminjamanChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: {!! json_encode($data) !!},
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.4,
                    pointRadius: 4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                interaction: { mode: 'index', intersect: false },
                scales: {
                    x: {
                        title: { display: true, text: 'Tanggal' },
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Dipinjam' },
                        grid: { color: 'rgba(0, 0, 0, 0.1)' }
                    }
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const notifList = document.getElementById('notifList');
            const notifCount = document.getElementById('notifCount');
            const toastContainer = document.getElementById('toastContainer');

            const aktivitas = [
                @foreach ($peminjamanTerbaru as $item)
                    {
                        jenis: 'peminjaman',
                        nama: "{{ $item->nama_peminjam }}",
                        waktu: "{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->toISOString() }}",
                        barang: "{{ $item->barang->nama_barang ?? 'Barang tidak diketahui' }}"
                    },
                @endforeach
            ];

            notifList.innerHTML = '';
            if (aktivitas.length > 0) {
                notifCount.style.display = 'inline-block';
                notifCount.innerText = aktivitas.length;

                aktivitas.forEach(item => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <a href="{{ route('peminjaman.index') }}" class="dropdown-item">
                            <strong>${item.nama}</strong> melakukan <strong>${item.jenis}</strong><br>
                            Barang: ${item.barang}<br>
                            <small class="text-muted" data-time="${item.waktu}">${dayjs(item.waktu).fromNow()}</small>
                        </a>
                    `;
                    notifList.appendChild(li);
                });
            } else {
                notifCount.style.display = 'none';
                const li = document.createElement('li');
                li.innerHTML = `<span class="dropdown-item-text text-muted">Tidak ada notifikasi</span>`;
                notifList.appendChild(li);
            }

            function showToast(message, time) {
                const toast = document.createElement('div');
                toast.innerHTML = `
                    ${message}<br><small data-time="${time}">${dayjs(time).fromNow()}</small>
                `;
                toast.addEventListener('click', () => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                });
                toastContainer.appendChild(toast);
                setTimeout(() => toast.style.opacity = '1', 100);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }, 5000);
            }

            aktivitas.forEach(item => {
                const message = `<strong>${item.nama}</strong> meminjam <em>${item.barang}</em>`;
                showToast(message, item.waktu);
            });

            //  Update waktu setiap 60 detik
            setInterval(() => {
                document.querySelectorAll('[data-time]').forEach(el => {
                    const iso = el.dataset.time;
                    if (iso) el.textContent = dayjs(iso).fromNow();
                });
            }, 60000);
        });
    </script>

    <style>
        #notifButton {
            width: 48px;
            height: 48px;
            font-size: 1.3rem;
        }

        .hover-zoom:hover {
            transform: scale(1.02);
            transition: 0.3s;
        }

        #toastContainer div {
            background: #0d6efd;
            color: white;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.3rem;
            box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
            opacity: 0;
            transition: opacity 0.5s ease;
            cursor: pointer;
        }

        #toastContainer div:hover {
            box-shadow: 0 0 15px rgba(13, 110, 253, 0.8);
        }

        /* Agar badge notif selalu bulat dan proporsional */
        #notifCount {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            font-weight: 600;
        }
        /* Hover efek pada profile */
        #profileDropdown:hover, #notifButton:hover {
            box-shadow: 0 2px 12px rgba(25, 118, 210, 0.08);
            background: #f5faff;
        }
    </style>

@endsection
