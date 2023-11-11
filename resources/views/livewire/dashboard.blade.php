<div>
    <div class="text-dark p-3">
        <h3 class="fw-bold">DASHBOARD</h3>
        <hr class="mb-0">
    </div>

    <div class="container text-dark py-3 px-1">
        <div class="row g-4 p-3">
            <div class="col-12">
                <div class="card bg-audience" style="overflow: hidden; height: 130px; background-color: white;">
                    <div class="header d-flex align-items-center h-100 p-3">
                        <div class="gx-1 text-light fw-bold ps-3" style="font-size: 28px;">
                            Welcome, {{ Auth::user()->profileable->first_name. ' ' .Auth::user()->profileable->last_name
                            }}!
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
                                    {{ $teamsCount }}
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
                                {{-- If event(s) found --}}
                                @foreach ($todayEvents as $todayEvent)
                                <a wire:key="{{ $todayEvent->id }}" class="nav-link"
                                    wire:navigate href="{{ route('events.show', ['event' => $todayEvent->id]) }}">
                                    <div class="row g-4 p-2">
                                        <div class="col-auto mt-2">
                                            <span style="font-size: 50px"><i class="bi bi-calendar-event"></i></span>
                                        </div>

                                        <div class="col mt-2 text-truncate">
                                            <p class="d-inline-block text-truncate pt-2 mb-0" style="font-size: 20px;">
                                                {{
                                                $todayEvent->name }}</p>
                                            <p class="pt-0 mb-0" style="font-size: 14px;"><i
                                                    class="bi bi-geo-alt me-1"></i>{{
                                                $todayEvent->venue }}</p>
                                        </div>
                                    </div>
                                </a>
                                <hr class="mt-0 mb-3">
                                @endforeach

                                {{-- If no events found --}}
                                @if($todayEvents->count() == 0)
                                <div class="row g-4 p-2">
                                    <div class="col-auto mt-4">
                                        <p>No events today</p>
                                    </div>
                                </div>
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
                                {{-- If event(s) found --}}
                                @foreach ($upcomingEvents as $upcomingEvent)
                                <a wire:key="{{ $upcomingEvent }}" class="nav-link"
                                    wire:navigate href="{{ route('events.show', ['event' => $upcomingEvent->id])}}">
                                    <div class="row g-4 p-2">
                                        <div class="col-auto mt-2">
                                            <span style="font-size: 50px"><i class="bi bi-calendar-event"></i></span>
                                        </div>

                                        <div class="col mt-2 text-truncate">
                                            <p class="d-inline-block text-truncate pt-2 mb-0" style="font-size: 20px;">
                                                {{
                                                $upcomingEvent->name }}</p>
                                            <p class="pt-0 mb-0" style="font-size: 14px;"><i
                                                    class="bi bi-clock me-1"></i>{{
                                                \Carbon\Carbon::parse($upcomingEvent->starts_at)->format('M. d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <hr class="mt-0 mb-3">
                                @endforeach

                                {{-- If no events found --}}
                                @if($upcomingEvents->count() == 0)
                                <div class="row g-4 p-2">
                                    <div class="col-auto mt-4">
                                        <p>No upcoming events</p>
                                    </div>
                                </div>
                                <hr class="mt-0 mb-3">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>