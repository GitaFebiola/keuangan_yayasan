<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan Yayasan</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fdfb;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background: #155c3d;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
            z-index: 1030;
        }

        .sidebar .brand {
            font-size: 1.25rem;
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            background-color: #157f54;
        }

        .sidebar a {
            color: #e0f7ea;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .sidebar a.active {
            background-color: #ffffff;
            color: #155c3d;
            font-weight: bold;
        }

        .navbar-custom {
            margin-left: 250px;
            background-color: white;
            padding: 0.8rem 1.5rem;
            border-bottom: 1px solid #dee2e6;
            position: fixed;
            width: calc(100% - 250px);
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .content {
            margin-left: 250px;
            padding: 100px 30px 30px;
        }

        .table th {
            background-color: #d1e7dd;
        }

        .btn-primary {
            background-color: #157f54;
            border-color: #157f54;
        }

        .btn-primary:hover {
            background-color: #136c48;
            border-color: #136c48;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="brand">
    <i class="fas fa-school me-2"></i>Keuangan Yayasan
</div>

        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <a href="{{ url('/pemasukan/create') }}" class="{{ request()->is('pemasukan/create') ? 'active' : '' }}">
            <i class="fas fa-arrow-down"></i> Input Pemasukan
        </a>
        <a href="{{ url('/pengeluaran/create') }}" class="{{ request()->is('pengeluaran/create') ? 'active' : '' }}">
            <i class="fas fa-arrow-up"></i> Input Pengeluaran
        </a>
        <a href="{{ route('riwayat') }}" class="{{ request()->is('riwayat') ? 'active' : '' }}">
            <i class="fas fa-history"></i> Riwayat
        </a>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-custom">
        <span class="navbar-brand"><i class="fas fa-home me-2"></i>Dashboard Keuangan</span>
    </nav>

    {{-- Konten --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
