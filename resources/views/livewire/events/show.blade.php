<div>
    <div class="text-dark px-3 pt-3">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h3 class="fw-bold mb-0">
                    {{ $event->name }}
                </h3>
            </div>
        </div>
        <hr class="mb-0">
    </div>

    {{-- Sub Navigation --}}
    @include('livewire.inc.subnav_event')

    <div class="container text-dark pb-3">
        <div class="d-flex justify-content-between mb-3">
            <div class="px-3">
                <h5 class="fw-bold">Games</h5>
            </div>
            <div class="px-3">
                <a href="#" class="custBtn custBtn-light ms-3"><i class="bi bi-plus-lg"></i>&nbsp Add New Game</a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 px-3">
            @foreach ($games as $game)
            <div class="col" id="card-event">
                <a class="nav-link" href="#">
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