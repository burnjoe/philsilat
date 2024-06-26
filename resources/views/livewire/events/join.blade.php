@php
$index = 0;
@endphp

<div>
    <div class="text-dark p-3">
        <h3 class=" fw-bold">CREATE A TEAM</h3>
        <hr class="mb-0">
    </div>

    <div class="container">
        <div class="container-fluid text-dark py-3">
            <form wire:submit.prevent="joinEvent">
                <h5 class=" fw-bold">Team Information</h5>
                <div class="p-4"
                    style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                    <div class="row row-cols-1 row-cols-lg-2 g-4">
                        {{-- Team Name --}}
                        <div class="form-group col">
                            <label for="name">Team Name<span style="color: #b63e3e;">
                                    *</span></label>
                            <input wire:model="name" id="name"
                                class="form-control custInput @error('name') is-invalid @enderror" type="text"
                                autocomplete="off" placeholder="Team Name" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mt-5">Athletes Information</h5>
                @foreach ($games as $game)
                <div wire:key="{{ $game->id }}" class="p-4 mb-4"
                    style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                    <h5 class=" fw-bold">{{ $game->name . ' (' . $game->category->sex . ') — Class ' .
                        $game->category->class_label }}</h5>
                    <hr class="mt-1 mb-4">

                    {{-- Profile Photo --}}                  
                    <div class="d-flex justify-content-center">
                        <div class="mx-auto" style="text-align: center">
                            <div>
                                <img class="object-fit-fill border rounded-circle align-center"
                                src="{{ isset($athletes[$index]) ? $athletes[$index]['profile_photo']->temporaryUrl() : asset('img/user_icon.png') }}"
                                alt="Profile Picture" height="150px" width="150px">
                            </div>
                            <div class="form-group col pt-4">
                                <label for="profile_photo{{$index}}">Profile Photo<span style="color: #b63e3e;">
                                        *</span></label>
                                <input wire:model="athletes.{{$index}}.profile_photo" id="profile_photo{{$index}}"
                                    class="form-control custInput @error('athletes.'.$index.'.profile_photo') is-invalid @enderror"
                                    type="file" placeholder="ID Photo" required>
                                @error('athletes.'.$index.'.profile_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Last Name & First Name --}}
                    <div class="row row-cols-1 row-cols-sm-2 g-4 pt-4">
                        <div class="form-group col">
                            <label for="last_name{{$index}}">Last Name<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="athletes.{{$index}}.last_name" id="last_name{{$index}}"
                                class="form-control custInput @error('athletes.'.$index.'.last_name') is-invalid @enderror"
                                type="text" autocomplete="off" placeholder="Last Name" required autofocus>
                            @error('athletes.'.$index.'.last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="first_name{{$index}}">First Name<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="athletes.{{$index}}.first_name" id="first_name{{$index}}"
                                class="form-control custInput @error('athletes.'.$index.'.first_name') is-invalid @enderror"
                                type="text" autocomplete="off" placeholder="First Name" required autofocus>
                            @error('athletes.'.$index.'.first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Birthdate & Sex & Weight --}}
                    <div class="row row-cols-1 row-cols-sm-3 g-4 pt-4">
                        <div class="form-group col">
                            <label for="birthdate{{$index}}">Date of Birth<span style="color: #b63e3e;">
                                    *</span></label>
                            <input wire:model="athletes.{{$index}}.birthdate" id="birthdate{{$index}}"
                                class="form-control custInput @error('athletes.'.$index.'.birthdate') is-invalid @enderror"
                                type="date" autocomplete="off" required style="cursor: text;">
                            @error('athletes.'.$index.'.birthdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="sex{{$index}}">Sex<span style="color: #b63e3e;"> *</span></label>
                            <select wire:model="athletes.{{$index}}.sex" id="sex{{$index}}"
                                class="form-select custFormSelect @error('athletes.'.$index.'.sex') is-invalid @enderror"
                                aria-label=".form-select example" required>
                                <option class="custOption" hidden>Sex</option>
                                <option class="custOption" value="Male">Male</option>
                                <option class="custOption" value="Female">Female</option>
                            </select>
                            @error('athletes.'.$index.'.sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="weight{{$index}}">Weight (kg)<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="athletes.{{$index}}.weight" id="weight{{$index}}"
                                class="form-control custInput @error('athletes.'.$index.'.weight') is-invalid @enderror"
                                type="number" autocomplete="off" placeholder="Weight" required autofocus>
                            @error('athletes.'.$index.'.weight')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- School & Grade Level & LRN --}}
                    <div class="row row-cols-1 row-cols-sm-3 g-4 pt-4 pb-4">
                        <div class="form-group col">
                            <label for="school_name{{$index}}">Name of the School<span style="color: #b63e3e;">
                                    *</span></label>
                            <input wire:model="athletes.{{$index}}.school_name" id="school_name{{$index}}"
                                class="form-control custInput @error('athletes.'.$index.'.school_name') is-invalid @enderror"
                                type="text" autocomplete="off" placeholder="School Name" required autofocus>
                            @error('athletes.'.$index.'.school_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="grade_level{{$index}}">Grade Level<span style="color: #b63e3e;">
                                    *</span></label>
                            <input wire:model="athletes.{{$index}}.grade_level" id="grade_level{{$index}}"
                                class="form-control custInput @error('athletes.'.$index.'.grade_level') is-invalid @enderror"
                                type="number" autocomplete="off" placeholder="Grade Level" required autofocus>
                            @error('athletes.'.$index.'.grade_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="lrn{{$index}}">LRN<span style="color: #b63e3e;">
                                    *</span></label>
                            <input wire:model="athletes.{{$index}}.lrn" id="lrn{{$index}}"
                                class="form-control custInput @error('athletes.'.$index.'.lrn') is-invalid @enderror"
                                type="text" autocomplete="off" placeholder="LRN" required autofocus>
                            @error('athletes.'.$index.'.lrn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Increments --}}
                @php $index++; @endphp
                @endforeach

                <div class="form-group d-flex justify-content-end">
                    <a wire:navigate href="{{ route('events.details', ['event' => $event->id]) }}"
                        class="custBtn custBtn-light">Cancel</a>
                    <button type="submit" value="true" class="custBtn custBtn-green ms-3">Join Event</button>
                </div>
            </form>
        </div>
    </div>
</div>