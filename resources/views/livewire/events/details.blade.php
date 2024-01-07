<div>
    {{-- Sub Navigation --}}
    @include('livewire.inc.subnav_event')

    <div class="container text-dark pb-3">
        <div class="d-flex justify-content-between mb-3">
            <div class="px-3">
                <h5 class="fw-bold">Details</h5>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 g-4 px-3">
            <div class="col">
                <div>
                    <p class="fw-bold mb-0">Host:</p>
                    <p>{{ $event->host_name }}</p>
                </div>

                <div>
                    <p class="fw-bold mb-0">Start of Registration:</p>
                    <p class="mb-3">{{ \Carbon\Carbon::parse($event->registration_starts_at)->format('F j, Y') }}</p>
                </div>

                {{-- If event is one day --}}
                @if(\Carbon\Carbon::parse($event->starts_at)->isSameDay($event->ends_at))
                <div>
                    <p class="fw-bold mb-0">Event Date:</p>
                    <p class="mb-3">{{ \Carbon\Carbon::parse($event->starts_at)->format('F j, Y') }}</p>
                </div>
                @else
                {{-- If event is more than one day --}}
                <div>
                    <p class="fw-bold mb-0">Event Starts At:</p>
                    <p class="mb-3">{{ \Carbon\Carbon::parse($event->starts_at)->format('F j, Y') }}</p>
                </div>
                <div>
                    <p class="fw-bold mb-0">Event Ends At:</p>
                    <p class="mb-3">{{ \Carbon\Carbon::parse($event->ends_at)->format('F j, Y') }}</p>
                </div>
                @endif
                <div>
                    <p class="fw-bold mb-0">Time:</p>
                    <p class="mb-3">{{ \Carbon\Carbon::parse($event->starts_at)->format('g:i A') . ' - ' .
                        \Carbon\Carbon::parse($event->ends_at)->format('g:i A') }}</p>
                </div>
            </div>

            <div class="col">
                <div>
                    <p class="fw-bold mb-0">Venue:</p>
                    <p class="mb-3">{{ $event->venue }}</p>
                </div>

                {{-- If event is one day --}}
                <div>
                    <p class="fw-bold mb-0">Address:</p>
                    <p>{{ $event->address }}</p>
                </div>
                {{-- If event is more than one day --}}
                <div>
                    <p class="fw-bold mb-0">Registered Teams:</p>
                    <p>{{ $registeredTeams }}</p>
                </div>
            </div>

            <div class="col-sm-12 px-2">
                {{-- Male Games --}}
                <div class="mb-3 bg-white" style="overflow-x: auto; box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark text-light" style="white-space: nowrap;">
                            <th scope="col">Male - Games</th>
                            <th scope="col">Weight Range</th>
                        </thead>
                        <tbody>
                            @foreach ($maleGames as $game)
                            <tr scope="row" wire:key="{{ $game->id }}">
                                <td>{{ $game->name . ' - Class ' . $game->category->class_label }}</td>
                                <td>{{ $game->category->min_weight . 'kg - ' . $game->category->max_weight . 'kg' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- No Records Found --}}
                    @if ($maleGames->count() == 0)
                    <div class="d-flex justify-content-center align-items-center my-5">
                        <h4>No existing games.</h4>
                    </div>
                    @endif
                </div>

                {{-- Female Games --}}
                <div class="mb-3 bg-white" style="overflow-x: auto; box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark text-light" style="white-space: nowrap;">
                            <th scope="col">Female - Games</th>
                            <th scope="col">Weight Range</th>
                        </thead>
                        <tbody>
                            @foreach ($femaleGames as $game)
                            <tr scope="row" wire:key="{{ $game->id }}">
                                <td>{{ $game->name . ' - Class ' . $game->category->class_label }}</td>
                                <td>{{ $game->category->min_weight . 'kg - ' . $game->category->max_weight . 'kg' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- No Records Found --}}
                    @if ($femaleGames->count() == 0)
                    <div class="d-flex justify-content-center align-items-center my-5">
                        <h4>No existing games.</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>