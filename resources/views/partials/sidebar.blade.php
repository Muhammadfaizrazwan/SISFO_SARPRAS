<style>
    .sidebar {
        width: 250px;
        background-color: #1c1c1c;
        min-height: 100vh;
    }

    .sidebar .nav-link {
        color: #ced4da;
        padding: 12px 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
        border-radius: 12px;
        position: relative;
        transition: all 0.3s ease;
        margin-bottom: 10px;
        background-color: transparent;
    }

    .sidebar .nav-link:hover {
        background-color: #2c2f36;
        color: #ffffff;
    }

    .sidebar .nav-link.active {
        background-color: #1f2a38;
        color: #ffffff;
    }

    .sidebar .nav-link.active::before {
        content: "";
        position: absolute;
        left: 8px;
        top: 10%;
        height: 80%;
        width: 4px;
        background-color: #ff0033; /* Garis merah */
        border-radius: 10px;
    }
</style>

<div class="d-flex">
    <nav class="sidebar p-3">
        <h4 class="text-white mb-4">SISFO SARPRAS</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">Kategori</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('barang.index') ? 'active' : '' }}" href="{{ route('barang.index') }}">Barang</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('pengembalian.index') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">Pengembalian</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.barang') ? 'active' : '' }}" href="{{ route('laporan.barang') }}">Laporan barang</a></li>
            <li class="nav-item mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger btn-sm w-100">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="flex-grow-1 p-4">
        @yield('content')
        
    </div>

</div>
