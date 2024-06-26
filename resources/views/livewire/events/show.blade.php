<div>
    {{-- Sub Navigation --}}
    @include('livewire.inc.subnav_event')

    <div class="container text-dark pb-3">
        {{-- Alerts --}}
        @include('livewire.inc.alerts')

        <div class="d-flex justify-content-between mb-3 pt-3">
            <div class="px-3">
                <h5 class="fw-bold">Games</h5>
            </div>
            <div class="d-flex justify-content-end col">
                {{-- Search --}}
                @include('livewire.inc.search')
                @hasrole('admin')
                @if($event->status === "UPCOMING")
                <a wire:navigate href="{{ route('games.create', ['event' => $event->id]) }}"
                    class="custBtn custBtn-light me-3"><i class="bi bi-plus-lg"></i>&nbsp Add New Game</a>
                @endif
                @endhasrole
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 px-3">
            @foreach ($games as $game)
            <div class="col" id="card-event">
                <a wire:key="{{ $game->id }}" class="nav-link" wire:navigate
                    href="{{ route('games.matches', ['event' => $event->id, 'game' => $game->id]) }}">
                    <div class="card" style="height:18rem;">
                        <div class="card-body rounded overflow-hidden">
                            <div class="h-100 d-flex justify-content-center align-items-center p-3">
                                <h3 class="fs-5 fw-bold">
                                    {{ $game->name }} - Class {{ $game->category->class_label }} -
                                    {{$game->category->sex }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        {{-- No Records Found --}}
        @if($games->total() == 0)
        <div class="d-flex justify-content-center align-items-center my-5">
            @if(empty($search))
            <h4>No existing games.</h4>
            @else
            <h4>No records found for matching "{{$search}}".</h4>
            @endif
        </div>
        @endif

        {{-- Pagination Links --}}
        <div class="mx-4 mt-4">
            {{ $games->links() }}
        </div>
    </div>
</div>