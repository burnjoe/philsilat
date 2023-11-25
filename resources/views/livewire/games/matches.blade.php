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

        @foreach ($rounds as $round)
        <livewire:match-list wire:key="{{ $round->round }}" :event="$event" :game="$game" :round="$round->round" />
        @endforeach

        @if ($rounds->isEmpty())
        <livewire:match-list wire:key="1" :event="$event" :game="$game" :round="1" />
        @endif
    </div>
</div>