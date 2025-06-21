<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sidebar SISFO SARPRAS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

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

    .sidebar .nav-link i {
      margin-right: 12px;
      font-size: 18px;
      transition: transform 0.3s ease;
    }

    .sidebar .nav-link:hover {
      background-color: #2c2f36;
      color: #ffffff;
      transform: translateX(5px);
    }

    .sidebar .nav-link:hover i {
      transform: scale(1.2);
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
      background-color: #ff0033;
      border-radius: 10px;
    }

    .sidebar h4 {
      font-size: 22px;
      font-weight: bold;
      text-align: center;
    }

    .btn-logout {
      margin-top: 30px;
    }

    .submenu {
      padding-left: 30px;
    }

    .submenu .nav-link {
      padding: 8px 20px;
      font-weight: normal;
      font-size: 14px;
    }

    .submenu .nav-link i {
      font-size: 14px;
      margin-right: 10px;
    }

    .sidebar .collapse.show {
      animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <div class="d-flex">
    <nav class="sidebar p-3">
      <h4 class="text-white mb-4">SISFO SARPRAS</h4>
      <ul class="nav flex-column">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i> Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
            <i class="fas fa-list"></i> Kategori
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('barang.index') ? 'active' : '' }}" href="{{ route('barang.index') }}">
            <i class="fas fa-box"></i> Barang
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
            <i class="fas fa-hand-holding"></i> Peminjaman
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('pengembalian.index') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">
            <i class="fas fa-undo"></i> Pengembalian
          </a>
        </li>

        <!-- Dropdown Menu Laporan -->
<li class="nav-item">
  <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#laporanMenu" role="button" aria-expanded="false" aria-controls="laporanMenu">
    <span><i class="fas fa-chart-line"></i> Laporan</span>
    <i class="fas fa-chevron-down"></i>
  </a>
  <div class="collapse" id="laporanMenu">
    <ul class="nav flex-column submenu mt-2">
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('laporan.barang') ? 'active' : '' }}" href="{{ route('laporan.barang') }}">
          <i class="fas fa-file-alt"></i> Laporan Barang
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
          <i class="fas fa-file-signature"></i> Laporan Peminjaman
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('laporan.pengembalian') ? 'active' : '' }}" href="{{ route('laporan.pengembalian') }}">
          <i class="fas fa-file-export"></i> Laporan Pengembalian
        </a>
      </li>
    </ul>
  </div>
</li>


       
          </form>
        </li>

      </ul>
    </nav>

    <div class="flex-grow-1 p-4">
      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
