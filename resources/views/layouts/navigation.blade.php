<header class="sticky-top">
    {{-- Navigation --}}
    <nav class="navbar navbar-expand-md navbar-dark bg-black">
        <div class="container-fluid">
            <div class="d-flex flex-row align-items-center">
                {{-- Sidebar Toggler --}}
                @auth
                <a class="navbar-toggler d-block ms-1 text-light" id="btn" role="button">
                    <i class="bi bi-list"></i>
                </a>
                {{-- Navbar Brand --}}
                <a class="navbar-brand ms-2 fw-bold fs-5" wire:navigate href="{{ route('root') }}">PHILSILAT</a>
                @endauth
                @guest
                {{-- Navbar Brand --}}
                <div class="container-fluid">
                    <a class="navbar-brand ms-4 fw-bold fs-5" wire:navigate href="{{ route('root') }}">PHILSILAT</a>
                </div>
                @endguest

            </div>
            <div class="d-flex flex-row">

                @auth
                <p class="pDark m-auto me-4">{{ strtoupper(auth()->user()->getRoleNames()->first()) }}</p>
                @endauth

                {{-- Dropdown --}}
                @auth
                <ul class="navbar-nav ms-auto me-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" wire:navigate href="{{ route('profile') }}">
                                    <i class="bi bi-person me-3"></i>My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" wire:navigate href="{{ route('change-password') }}">
                                    <i class="bi bi-key me-3"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider opacity-50">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-3"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>
</header>