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
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="icon" href="img/core-img/logo.jpg">
    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style>
        /* Figma Layout Variables */
        :root {
            --bg-main: #C7A07A33; /* <-- Updated background color here */
            --card-white: #FFFCF8;
            --text-brown: #5C4334;
            --text-muted: #A69485;
            --nav-active-bg: #F0EAE1;
            --nav-hover-bg: #F8F5F0;
            --btn-brown: #8B6A4B;
        }

        /* Override Body to act as the dark background container */
        body {
            background-color: var(--bg-main); /* <-- Apply the updated variable here */
            margin: 0;
            padding: 20px;
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
            gap: 20px;
            height: 100%;
        }

        /* Floating Sidebar */
        .sidebar-card {
            background-color: var(--card-white);
            border-radius: 20px;
            width: 260px;
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Navigation Links */
        .nav-link-custom {
            color: var(--text-brown);
            padding: 12px 20px;
            border-radius: 10px;
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

        .nav-link-custom.active {
            background-color: var(--nav-active-bg);
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .nav-link-custom i {
            width: 24px; /* Ensure icons align perfectly */
        }

        /* Right Side Layout (Header + Content) */
        .right-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow: hidden;
        }

        /* Floating Header */
        .header-card {
            background-color: var(--card-white);
            border-radius: 20px;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .search-input {
            border: none;
            background: transparent;
            outline: none;
            color: var(--text-brown);
        }
        
        .search-input::placeholder {
            color: var(--text-muted);
        }

        /* Main Content Area */
        .content-scroll-area {
            flex-grow: 1;
            overflow-y: auto;
            padding-right: 5px; /* space for scrollbar */
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #5C4334;
            border-radius: 10px;
        }
    </style>
</head>

<body> 
    <div class="app-wrapper">
        
        <aside class="sidebar-card">
            <div class="text-center mb-5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 180px; object-fit: contain;">
            </div>

            <div class="flex-grow-1">
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

            <div class="mt-auto pt-3 text-center">
                <h6 class="serif-font fw-bold" style="color: var(--text-brown);">Account Center</h6>
                <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
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
            
            <header class="header-card shadow-sm">
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
                                    <span class="fw-bold d-block text-dark">{{ $user->name ?? 'Admin' }}</span>
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
    @yield('scripts')
</body>
</html>