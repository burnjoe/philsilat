<div>
    @include('livewire.inc.subnav_game')

    <div class="container text-dark pb-3 px-1">
        {{-- Alerts --}}
        @include('livewire.inc.alerts')

        <div class="container-fluid d-flex justify-content-between mb-1 pt-3">
            <div class="px-3">
                <h5 class="fw-bold">
                    Matches
                </h5>
            </div>
        </div>

        {{-- Results Summary --}}
        @if($game->is_completed)
        <div class="container-fluid d-flex justify-content-between mb-3 pt-3">
            <div class="px-3">
                <h5 class="fw-bold">
                    Result Summary
                </h5>
            </div>
        </div>

        {{-- Winners Table --}}
        <div class="mx-4 mb-2 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark text-light" style="white-space: nowrap;">
                    <th scope="col">Medal</th>
                    <th scope="col">Athlete</th>
                    <th scope="col">Team</th>
                </thead>
                <tbody style="white-space: nowrap;">
                    @foreach ($awards as $award)    
                    <tr wire:key="{{ $award->id }}">
                        <td>{{ $award->medal }}</td>
                        <td>{{ $award->athlete->last_name . ', ' . $award->athlete->first_name }}</td>
                        <td>{{ $award->athlete->team->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 my-5">
            <hr class="text-dark">
        </div>

        <div class="container-fluid d-flex justify-content-between mb-1 pt-0">
            <div class="px-3">
                <h5 class="fw-bold">
                    Match History
                </h5>
            </div>
        </div>
        @endif

        @foreach ($rounds as $round)
        <livewire:match-list wire:key="{{ $round->round }}" :event="$event" :game="$game" :round="$round->round" />
        @endforeach

        @if ($rounds->isEmpty())
        <livewire:match-list wire:key="1" :event="$event" :game="$game" :round="1" />
        @endif
    </div>
</div>