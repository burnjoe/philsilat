<div class="sidebar active">
    <ul>
        {{-- Dashboard --}}
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span class="nav-item">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>

        {{-- Categories --}}
        @can('manage categories')
        <li>
            <a href="{{ route('categories') }}">
                <i class="bi bi-clipboard2-check"></i>
                <span class="nav-item">Categories</span>
            </a>
            <span class="tooltip">Categories</span>
        </li>
        @endcan

        {{-- Events --}}
        <li>
            <a href="#">
                <i class="bi bi-calendar-event"></i>
                <span class="nav-item">Events</span>
            </a>
            <span class="tooltip">Events</span>
        </li>

        {{-- Accounts --}}
        @can('manage accounts')
        <li>
            <a href="{{ route('accounts') }}">
                <i class="bi bi-person-badge"></i>
                <span class="nav-item">Accounts</span>
            </a>
            <span class="tooltip">Accounts</span>
        </li>
        @endcan
</div>