<div>
    {{-- Info Alert --}}
    @if (session()->has('info'))
    <div class="alert alert-primary alert-dismissible fade show d-flex align-items-center mx-4" role="alert">
        <i class="bi bi-info-circle-fill"></i>
        <div class="ms-2">
            {{ session('info') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Success Alert --}}
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mx-4" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        <div class="ms-2">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Warning Alert --}}
    @if (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center mx-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div class="ms-2">
            {{ session('warning') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Danger Alert --}}
    @if (session()->has('danger'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mx-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div class="ms-2">
            {{ session('danger') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>