@php
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="icon" href="img/core-img/logo.jpg">
    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style>
        /* Updated Figma Layout Variables */
        :root {
            --bg-main: #FDFBF7; /* Cleaner background for the new layout */
            --card-white: #FFFFFF;
            --text-brown: #3E2723; /* Darker brown for active state */
            --text-muted: #A69485;
            --nav-active-bg: #F0EAE1;
            --nav-hover-bg: #F8F5F0;
            --btn-brown: #8B6A4B;
            --border-color: #EADFC8;
        }

        /* 1. Flush Body (No padding, no floating) */
        body {
            background-color: var(--bg-main);
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .serif-font {
            font-family: 'Abhaya Libre', serif;
        }

        /* App Wrapper */
        .app-wrapper {
            display: flex;
            height: 100%;
        }

        /* 2. Flush Sidebar (Full height, straight edges) */
        .sidebar-card {
            background-color: var(--card-white);
            width: 260px;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .sidebar-logo {
            padding: 30px 20px 20px;
            text-align: center;
        }

        /* 3. Scrollable Navigation Area */
        .nav-scroll-area {
            flex-grow: 1;
            overflow-y: auto;
            padding: 0 15px;
        }

        .nav-scroll-area::-webkit-scrollbar { width: 4px; }
        .nav-scroll-area::-webkit-scrollbar-thumb { background: #EADFC8; border-radius: 10px; }

        /* Navigation Links */
        .nav-link-custom {
            color: var(--text-muted);
            padding: 12px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-weight: 500;
            margin-bottom: 5px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover {
            background-color: var(--nav-hover-bg);
            color: var(--text-brown);
        }

        /* 4. Updated Active State (Darker brown, left border line) */
        .nav-link-custom.active {
            background-color: var(--nav-active-bg);
            color: var(--text-brown);
            font-weight: 600;
            border-left: 4px solid var(--btn-brown);
            border-radius: 0 8px 8px 0;
        }

        .nav-link-custom i { width: 24px; }

        /* 5. Fixed Account Center Footer */
        .sidebar-footer {
            padding: 20px 15px;
            border-top: 1px solid var(--border-color);
            background-color: var(--card-white);
            text-align: center;
        }

        /* Right Side Layout */
        .right-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* 6. Flush Header (Sticks to top) */
        .header-card {
            background-color: var(--card-white);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .search-input {
            border: none;
            background: transparent;
            outline: none;
            color: var(--text-brown);
        }
        
        .search-input::placeholder { color: var(--text-muted); }

        /* Main Content Area */
        .content-scroll-area {
            flex-grow: 1;
            overflow-y: auto;
            padding: 30px; 
        }

        /* Custom Scrollbar for Main Content */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DBC5A0; border-radius: 10px; }
    </style>
</head>

<body> 
    <div class="app-wrapper">
        
        <aside class="sidebar-card">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 120px; object-fit: contain;">
            </div>

            <div class="nav-scroll-area">
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                            <i class="fas fa-laptop me-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.notifications') }}" class="nav-link-custom {{ request()->routeIs('admin.notifications*') ? 'active' : '' }}">
                            <i class="fas fa-bell me-3"></i> Notifications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}" class="nav-link-custom {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                            <i class="fas fa-heart me-3"></i> Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.booking') }}" class="nav-link-custom {{ request()->routeIs('admin.booking*') ? 'active' : '' }}">
                            <i class="fas fa-shopping-cart me-3"></i> Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reviews') }}" class="nav-link-custom {{ request()->routeIs('admin.reviews*') ? 'active' : '' }}">
                            <i class="fas fa-comment-dots me-3"></i> Review
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <h6 class="serif-font fw-medium mb-3" style="color: var(--text-brown);">Account Center</h6>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    @if($user && $user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" width="45" height="45" class="rounded-circle shadow-sm" style="object-fit:cover;">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" width="45" height="45" class="rounded-circle shadow-sm">
                    @endif
                    
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn text-white rounded-pill px-4 fw-medium" style="background-color: var(--btn-brown); font-size: 0.9rem;">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="right-wrapper">
            
            <header class="header-card">
                <div class="d-flex align-items-center">
                    <i class="fas fa-search me-2 fs-5" style="color: var(--text-muted);"></i> 
                    <input type="text" placeholder="Search" class="search-input">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('admin.notifications') }}" class="text-decoration-none" style="color: var(--text-brown);">
                        <i class="fas fa-bell fs-5"></i>
                    </a>

                    <div class="dropdown">
                        <a href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center text-decoration-none">
                            @if($user && $user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" width="40" height="40" class="rounded-circle shadow-sm" style="object-fit:cover;">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" width="40" height="40" class="rounded-circle shadow-sm">
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2" aria-labelledby="profileDropdown">
                            <li class="dropdown-header d-flex align-items-center mb-1">
                                <div>
                                    <span class="fw-medium d-block text-dark">{{ $user->name ?? 'Admin' }}</span>
                                    <small class="text-muted">{{ ucfirst($user->role ?? 'Administrator') }}</small>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user me-2 text-muted"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2">
                                        <i class="fas fa-sign-out-alt me-2 text-muted"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="content-scroll-area">
                @yield('content')
            </main>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>