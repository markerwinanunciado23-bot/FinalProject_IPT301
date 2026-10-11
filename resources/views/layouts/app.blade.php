
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') | SLMS</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f4f7fb;
            color: #1f2937;
        }

        .navbar {
            background: #123b73;
        }

        .sidebar-link {
            display: block;
            padding: 12px 15px;
            margin-bottom: 5px;
            color: #334155;
            text-decoration: none;
            border-radius: 8px;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: #e0edff;
            color: #124ca0;
        }

        .page-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 5px 24px #0f172a0d;
        }

        .table thead th {
            background: #eff6ff;
            white-space: nowrap;
        }

        .form-label {
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4 py-3">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
        🏫 School Laboratory Management
    </a>
</nav>

<div class="container-fluid">
    <div class="row">

        <aside class="col-lg-2 col-md-3 bg-white min-vh-100 border-end p-3">
            <div class="small text-secondary fw-bold mb-2">
                MAIN MENU
            </div>

            <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               href="{{ route('dashboard') }}">Dashboard</a>

            <a class="sidebar-link {{ request()->routeIs('laboratories.*') ? 'active' : '' }}"
               href="{{ route('laboratories.index') }}">Laboratories</a>

            <a class="sidebar-link {{ request()->routeIs('equipment.*') ? 'active' : '' }}"
               href="{{ route('equipment.index') }}">Equipment</a>

            <a class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}"
               href="{{ route('students.index') }}">Students</a>

            <a class="sidebar-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}"
               href="{{ route('reservations.index') }}">Reservations</a>

            <a class="sidebar-link {{ request()->routeIs('maintenance.*') ? 'active' : '' }}"
               href="{{ route('maintenance.index') }}">Maintenance</a>
        </aside>

        <main class="col-lg-10 col-md-9 p-4">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please correct the following:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
