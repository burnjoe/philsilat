<div>
    @include('livewire.inc.subnav_game')

    <div class="container text-dark pb-3 px-1">
        <div class="container-fluid d-flex justify-content-between mb-3 pt-3">
            <div class="px-3">
                <h5 class="fw-bold">Matches</h5>
            </div>

            <div class="d-flex justify-content-end col">
                {{-- Search --}}
                @include('livewire.inc.search')
                <a href="#" class="custBtn custBtn-light me-3"><i class="bi bi-diagram-2"></i>&nbsp Generate Matches</a>
            </div>
        </div>

        <div class="mx-4 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark text-light">
                    <th scope="col">Red Corner</th>
                    <th scope="col">Blue Corner</th>
                    <th scope="col">Round</th>
                    <th scope="col">Round Winner</th>
                </thead>
                <tbody>
                    @foreach ($matches as $match)
                    <tr scope="row" wire:key="{{ $match->id }}">
                        <td>{{ $match->athlete1->last_name }}</td>
                        <td>{{ $match->athlete2->last_name }}</td>
                        <td>{{ $match->round }}</td>
                        <td>{{ $match->winner->last_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- No Records Found --}}
            @if($matches->total() == 0)
            <div class="d-flex justify-content-center align-items-center my-5">
                @if(empty($search))
                <h4>No existing records.</h4>
                @else
                <h4>No records found for matching "{{$search}}".</h4>
                @endif
            </div>
            @endif
        </div>

        {{-- Pagination Links --}}
        <div class="mx-3 mt-4">
            {{ $matches->links() }}
        </div>
    </div>
</div>