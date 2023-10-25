<div>
    <div class="text-dark p-3">
        <div class="d-flex align-items-center">
            <h3 class="fw-bold mb-0">EVENTS</h3>
        </div>
        <hr class="mb-0">
    </div>

    <div class="container">
        {{-- Alerts --}}
        @include('livewire.inc.alerts')

        {{-- Search and Add Button --}}
        <div class="container-fluid d-flex justify-content-between py-3">
            <div class="d-flex align-items-center">
                <input wire:model.live.debounce.300ms="search" class="form-control custInput" type="text" name="search"
                    placeholder="Search" autocomplete="off">
                <i class="bi bi-search ms-2" aria-hidden="true"></i>
            </div>
            <div style="white-space: nowrap;">
                <a href="{{ route('events.create') }}" class="custBtn custBtn-light ms-3"><i
                        class="bi bi-plus-lg"></i>&nbsp
                    Add New Event</a>
            </div>
        </div>

        {{-- Events Card --}}
        @if ($events)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 px-3 py-2">
            @foreach ($events as $event)
            <div class="col" id="card-event">
                <a class="nav-link" href="{{ route('events.show', ['event' => $event->id]) }}">
                    <div class="card" style="height:18rem;">
                        <div class="card-body rounded overflow-hidden p-3">
                            <p class="m-0" style="font-size: 14px; color: {{$statusColor[$event->status]}};">
                                <i class="bi bi-info-circle"></i>
                                <span class="ms-1"><em>{{ $event->status }}</em></span>
                            </p>
                            <p class="d-flex justify-content-center mt-4 mb-0" style="font-size: 60px">
                                <i class="bi bi-calendar-event"></i>
                            </p>
                            <div class="d-flex justify-content-center align-items-center p-0 mb-5">
                                <h3 class="fs-5 fw-bold mb-0">{{ $event->name }} {{$event->id}}</h3>
                            </div>
                            <p class="m-0" style="font-size: 14px"><small><b>Date / Time:</b></small></p>
                            <p class="m-0" style="font-size: 14px">{{
                                \Carbon\Carbon::parse($event->starts_at)->format('M.
                                d, Y - h:i A') }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif

        {{-- No Records Found --}}
        @if($events->total() == 0)
        <div class="d-flex justify-content-center align-items-center my-5">
            @if(empty($search))
            <h4>No existing events.</h4>
            @else
            <h4>No events found for matching "{{$search}}".</h4>
            @endif
        </div>
        @endif

        {{-- Pagination Links --}}
        <div class="mx-3 mt-4">
            {{ $events->links() }}
        </div>
    </div>
</div>