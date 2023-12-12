<div>
    {{-- Sub Navigation --}}
    @include('livewire.inc.subnav_event')

    <div class="container text-dark pb-3">
        <div class="d-flex justify-content-between mb-3">
            <div class="px-3">
                <h5 class="fw-bold">{{ $team->name }}</h5>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 g-4 px-3">
            <div class="col">
                <div>
                    <p class="fw-bold mb-0">Number of Athletes:</p>
                    <p>{{ $athletes->total() }}</p>
                </div>
            </div>

            <div class="col">
                <div>
                    <p class="fw-bold mb-0">Date Joined:</p>
                    <p>{{ \Carbon\Carbon::parse($team->created_at)->format('F j, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="px-3 mb-4 pt-4">
            <h5 class="fw-bold">Coaches</h5>
        </div>

        <div class="mx-3 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark text-light">
                    <th scope="col">Coach</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                </thead>
                <tbody>
                    {{-- Coach data --}}
                    @foreach ($coaches as $coach)
                    <tr scope="row" wire:key="{{ $coach->id }}">
                        <td>{{ $coach->last_name . ', ' . $coach->first_name }}</td>
                        <td>{{ $coach->sex }}</td>
                        <td>{{ $coach->phone }}</td>
                        <td>{{ $coach->user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- No Records Found --}}
            @if ($coaches->count() == 0)
            <div class="d-flex justify-content-center align-items-center my-5">
                <h4>No existing records.</h4>
            </div>
            @endif
        </div>

        <div class="px-3 my-5">
            <hr class="text-dark">
        </div>

        {{-- Athletes Section --}}
        <div class="d-flex justify-content-between mb-3">
            <div class="px-3 d-flex align-items-center">
                <h5 class="fw-bold">Athletes</h5>
            </div>
            <div class="d-flex justify-content-end col">
                {{-- Search --}}
                @include('livewire.inc.search')
            </div>
        </div>

        {{-- Athletes Table --}}
        <div class="mx-3 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark text-light">
                    <th scope="col">Athlete</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">
                        <ul class="navbar-nav ms-auto me-2">
                            <li class="nav-item dropdown" wire:click.away="closeSexDropdown">
                                <a wire:click="toggleSexDropdown" class="nav-link dropdown-toggle py-0" role="button"
                                    aria-expanded="{{ $isSexDropdownOpen ? 'true' : 'false' }}">
                                    Sex
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark"
                                    style="{{ $isSexDropdownOpen ? 'display: block;' : 'display: none;' }}">
                                    <li>
                                        <a class="dropdown-item">
                                            <input wire:model.live.debounce.300ms="selectedSexes"
                                                class="form-check-input me-1" type="checkbox" value="Male" id="male">
                                            <label class="form-check-label fs-6 fw-normal" for="male">Male</label>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item">
                                            <input wire:model.live.debounce.300ms="selectedSexes"
                                                class="form-check-input me-1" type="checkbox" value="Female"
                                                id="female">
                                            <label class="form-check-label fs-6 fw-normal" for="female">Female</label>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </th>
                    <th scope="col">Weight (kg)</th>
                    <th scope="col">School</th>
                    <th scope="col">Grade Level</th>
                    <th scope="col">Joined Game</th>
                </thead>
                <tbody>
                    {{-- Atheletes Data --}}
                    @foreach ($athletes as $athlete)
                    <tr scope="row" wire:key="{{ $athlete->id }}">
                        <td>{{ $athlete->last_name . ', ' . $athlete->first_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($athlete->birthdate)->format('M. j, Y') }}</td>
                        <td>{{ $athlete->sex }}</td>
                        <td>{{ $athlete->weight.' kg' }}</td>
                        <td>{{ $athlete->school_name }}</td>
                        <td>{{ $athlete->grade_level }}</td>
                        <td>{{ $athlete->game->name . ': Class ' . $athlete->game->category->class_label . ' - ' . $athlete->game->category->sex }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- No Records Found --}}
            @if ($athletes->total() == 0)
            <div class="d-flex justify-content-center align-items-center my-5">
                @if (empty($search))
                <h4>No existing records.</h4>
                @else
                <h4>No records found for matching "{{ $search }}".</h4>
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