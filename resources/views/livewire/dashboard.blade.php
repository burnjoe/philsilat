<div>
    <div class="row g-4 p-3">
        <div class="container text-dark pt-3">
            <h3 class="fw-bold">DASHBOARD</h3>
            <hr class="mb-0">
        </div>
    </div>

    <div class="row g-4 p-3">
        <div class="col-12">
            <div class="card bg-audience" style="overflow: hidden; height: 130px; background-color: white;">
                <div class="header d-flex align-items-center h-100 p-3">
                    <div class="gx-1 text-light fw-bold ps-3" style="font-size: 28px;">
                        Welcome, {{ Auth::user()->profileable->first_name. ' ' .Auth::user()->profileable->last_name }}!
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    {{-- Total Numbers --}}
    <div class="row row-cols-1 row-cols-lg-3 g-4 p-3">
        <div class="col">
            <div class="card" style="height:130px; background-color: white;">
                <div class="header h-100 p-3">
                    <div class="row row-cols-2 g-4 p-3">
                        <div class="mt-3 gx-1" style="color: #3a4c88; font-size: 3rem;">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="row d-flex justify-content-end align-items-center gx-1 mt-3">
                            <span class="text-end">Events</span>
                            <span class="fs-2 text-end">
                                {{ $events->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="height:130px; background-color: white;">
                <div class="header h-100 p-3">
                    <div class="row row-cols-2 g-4 p-3">
                        <div class="mt-3 gx-1" style="color: #3a4c88; font-size: 3rem;">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="row d-flex justify-content-end align-items-center gx-1 mt-3">
                            <span class="text-end">Coaches</span>
                            <span class="fs-2 text-end">
                                {{ $coachesCount }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="height:130px; background-color: white;">
                <div class="header h-100 p-3">
                    <div class="row row-cols-2 g-4 p-3">
                        <div class="mt-3 gx-1" style="color: #3a4c88; font-size: 3rem;">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="row d-flex justify-content-end align-items-center gx-1 mt-3">
                            <span class="text-end">Teams</span>
                            <span class="fs-2 text-end">
                                {{ $events->pluck('teams')->flatten()->count(); }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row g-4 p-3">
        <div class="col-12 col-lg-8">
            <div class="card" style="overflow: hidden; height: 958px; background-color: white;">
                <div class="header d-flex align-items-center bg-dark h-100 p-3" style="max-height: 6.1%;">
                    <div class="gx-1 text-light fw-bold" style="font-size: 15px;">
                        <span class="text-light">Content</span>
                    </div>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    ...
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="row">
                {{-- Date --}}
                <div class="col-12">
                    <div class="card" style="overflow: hidden; height: 130px; background-color: white;">
                        <div class="header bg-audience h-100 p-3" style="overflow: hidden; max-height: 100%;">
                            <div class="gx-1 text-light ps-3" style="font-size: 24px;">
                                <div class="row align-items-center gx-1">
                                    <span class="text-end">{{ now()->format('D, M Y')}}</span>
                                    <span class="fw-bold text-end" style="font-size: 3rem;">{{ now()->format('d')
                                        }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Today's Event --}}
                <div class="col-12 mt-4">
                    <div class="card" style="overflow: hidden; height: 390px; background-color: white;">
                        <div class="header d-flex align-items-center bg-dark h-100 p-3" style="max-height: 15%;">
                            <div class="gx-1 text-light fw-bold" style="font-size: 15px;">
                                <span class="text-light">Today's Events</span>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-y: auto;">
                            {{-- If no events found --}}
                            @if(false)
                            <div class="row g-4 p-2">
                                <div class="col-auto mt-4">
                                    <p>No events found</p>
                                </div>
                            </div>
                            <hr class="mt-0 mb-3">
                            @else
                            {{-- If event(s) found --}}
                            <a class="nav-link" href="#">
                                <div class="row g-4 p-2">
                                    <div class="col-auto mt-2">
                                        <span style="font-size: 50px"><i class="bi bi-calendar-check"></i></span>
                                    </div>

                                    <div class="col mt-2">
                                        <p class="pt-2 mb-0" style="font-size: 20px;">Event Name</p>
                                        <p class="pt-0 mb-0" style="font-size: 14px;"><i class="bi bi-geo-alt"></i>
                                            Venue</p>
                                    </div>
                                </div>
                            </a>
                            <hr class="mt-0 mb-3">
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Upcoming Events --}}
                <div class="col-12 mt-4">
                    <div class="card" style="overflow: hidden; height: 390px; background-color: white;">
                        <div class="header d-flex align-items-center bg-dark h-100 p-3" style="max-height: 15%;">
                            <div class="gx-1 text-light fw-bold" style="font-size: 15px;">
                                <span class="text-light">Upcoming Events</span>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-y: auto;">
                            {{-- If no events found --}}
                            @if(false)
                            <div class="row g-4 p-2">
                                <div class="col-auto mt-4">
                                    <p>No events found</p>
                                </div>
                            </div>
                            <hr class="mt-0 mb-3">
                            @else
                            {{-- If event(s) found --}}
                            <a class="nav-link" href="#">
                                <div class="row g-4 p-2">
                                    <div class="col-auto mt-2">
                                        <span style="font-size: 50px"><i class="bi bi-calendar-event"></i></span>
                                    </div>

                                    <div class="col mt-2">
                                        <p class="pt-2 mb-0" style="font-size: 20px;">Event Name</p>
                                        <p class="pt-0 mb-0" style="font-size: 14px;"><i class="bi bi-clock"></i> Date
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <hr class="mt-0 mb-3">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>