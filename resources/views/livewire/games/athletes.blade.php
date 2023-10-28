<div>
    @include('livewire.inc.subnav_game')

    <div class="container text-dark py-3 px-1">
        <div class="container-fluid d-flex justify-content-between mb-3">
            <div class="px-3">
                <h5 class="fw-bold">Athletes</h5>
            </div>

            {{-- Search --}}
            @include('livewire.inc.search')
        </div>

        <div class="mx-4 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark text-light">
                    <th scope="col">Team Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Weight (kg)</th>
                    <th scope="col">School</th>
                    <th scope="col">Grade Level</th>
                </thead>
                <tbody>
                    @foreach ($athletes as $athlete)
                    <tr scope="row" wire:key="{{ $athlete->id }}">
                        <td>{{ $athlete->team->name }}</td>
                        <td>{{ $athlete->last_name }}</td>
                        <td>{{ $athlete->first_name }}</td>
                        <td>{{ $athlete->weight }}</td>
                        <td>{{ $athlete->school_name }}</td>
                        <td>{{ $athlete->grade_level }}</td>    
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- No Records Found --}}
            @if($athletes->total() == 0)
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
            {{ $athletes->links() }}
        </div>
    </div>
</div>