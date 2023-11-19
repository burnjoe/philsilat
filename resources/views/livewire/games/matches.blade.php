<div>
    @include('livewire.inc.subnav_game')

    <div class="container text-dark pb-3 px-1">
        {{-- Alerts --}}
        @include('livewire.inc.alerts')

        <div class="container-fluid d-flex justify-content-between mb-3 pt-3">
            <div class="px-3">
                <h5 class="fw-bold">
                    Matches — Round {{ $round }}

                    @if($matches->count() === 2)
                    (Semi-Finals)
                    @elseif($matches->count() === 1)
                    (Finals)
                    @if($matches->first()->is_closed)
                    <span class="badge text-bg-success py-1 ms-1">Completed</span>
                    @endif
                    @else
                    (Elimination)
                    @endif
                </h5>
            </div>

            <div class="d-flex justify-content-end col">
                {{-- Search --}}
                @include('livewire.inc.search')
                @if($rounds->count() >= 1 && $matches->count() > 1 && !$matches->where('winner_id', null)->count() > 0
                && !$matches->first()->is_closed)
                <button wire:click="generateMatches" class="custBtn custBtn-light me-3">Generate Next Round &nbsp<i
                        class="bi bi-arrow-right"></i></button>
                @elseif($matches->count() == 1 && !$matches->first()->is_closed && $matches->first()->winner_id)
                <button wire:click="closeMatchesOfRound({{$round}})" class="custBtn custBtn-light me-3"><i
                        class="bi bi-lock-fill"></i>&nbsp Mark Game Complete</button>
                @endif
            </div>
        </div>

        <div class="mx-4 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark text-light" style="white-space: nowrap;">
                    <th scope="col">Game #</th>
                    <th scope="col">Red Corner</th>
                    <th scope="col">Blue Corner</th>
                    <th scope="col">
                        <ul class="navbar-nav ms-auto me-2">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle py-0" role="button" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false">
                                    Round
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    @foreach ($rounds as $_round)
                                    <li>
                                        <a class="dropdown-item">
                                            <input wire:model.live.debounce.300ms="round" class="form-check-input me-1"
                                                type="radio" value="{{ $_round->round }}" id="{{ $_round->round }}">
                                            <label class="form-check-label fs-6 fw-normal" for="{{ $_round->round }}">
                                                Round {{ $_round->round }}
                                            </label>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </th>
                    <th scope="col">Round Winner</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody style="white-space: nowrap;">
                    @foreach ($matches as $match)
                    <tr scope="row" wire:key="{{ $match->id }}">
                        <td>
                            {{ $match->game_no }}
                        </td>
                        <td>
                            <span class="badge text-bg-danger py-1 me-1">{{ $match->athlete1->team->name ?? '' }}</span>
                            {{ $match->athlete1->last_name ?? 'N/A' }}
                        </td>
                        <td>
                            <span class="badge text-bg-primary py-1 me-1">{{ $match->athlete2->team->name ?? ''
                                }}</span>
                            {{ $match->athlete2->last_name ?? 'N/A' }}
                        </td>
                        <td>{{ $match->round }}</td>
                        <td>
                            @if($match->winner)

                            @php
                            $badgeColor = $match->winner->team->id === $match->athlete1->team->id ? 'danger' :
                            'primary';
                            @endphp

                            <span class="badge text-bg-{{$badgeColor}} py-1 me-1">{{ $match->winner->team->name
                                }}</span>
                            {{ $match->winner->last_name }}
                            @else
                            <div>
                                <select wire:model.live.debounce.300ms="winner_id" name="winner"
                                    class="form-select custFormSelect @error('sex') is-invalid @enderror"
                                    aria-label=".form-select example" style="font-size: 12;" required>
                                    <option class="custOption" hidden>Select Round Winner</option>
                                    <option class="custOption" value="{{ $match->athlete1->id }}">{{
                                        $match->athlete1->team->name }}</option>
                                    @if($match->athlete2)
                                    <option class="custOption" value="{{ $match->athlete2->id }}">{{
                                        $match->athlete2->team->name }}</option>
                                    @endif
                                </select>
                                @error('winner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endif
                        </td>
                        <td>
                            @if($match->winner && !$match->is_closed)
                            <button wire:click="denounceWinner({{$match->winner->id}})" class="custBtn custBtn-light"><i
                                    class="bi bi-arrow-counterclockwise"></i>&nbsp
                                Undo</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- No Records Found --}}
            @if($matches->total() == 0)
            <div class="d-flex justify-content-center align-items-center my-5">
                @if(empty($search))
                <div class="d-flex row">
                    <div class="d-flex justify-content-center">
                        <h4>No existing records.</h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button wire:click="generateMatches" class="custBtn custBtn-light me-3"><i
                                class="bi bi-diagram-2"></i>&nbsp
                            Generate Matches</button>
                    </div>
                </div>
                @else
                <div class="d-flex justify-content-center">
                    <h4>No records found for matching "{{$search}}".</h4>
                </div>
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