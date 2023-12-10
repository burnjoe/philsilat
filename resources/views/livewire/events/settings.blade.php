<div>
    {{-- Sub Navigation --}}
    @include('livewire.inc.subnav_event')

    <div class="container text-dark pb-3">
        {{-- Alerts --}}
        @include('livewire.inc.alerts')

        <div class="d-flex justify-content-between mb-3 pt-3">
            <div class="px-3">
                <h5 class="fw-bold">Event Settings</h5>
            </div>
        </div>

        <div class="container-fluid text-dark py-3">
            <div class="px-1">
                <h5 class="fw-bold">Edit Event</h5>
            </div>

            <div class="p-4"
                style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">

                <form wire:submit.prevent="update">
                    <div class="row row-cols-1 row-cols-lg-2 g-4">
                        {{-- Host Name --}}
                        <div class="form-group col">
                            <label for="host_name">Host Name (First Name Last Name)<span style="color: #b63e3e;">
                                    *</span></label>
                            <input wire:model="host_name" id="host_name"
                                class="form-control custInput @error('host_name') is-invalid @enderror" type="text"
                                name="host_name" autocomplete="off" placeholder="e.g., Juan Dela Cruz" required
                                autofocus>
                            @error('host_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Event Name --}}
                        <div class="form-group col">
                            <label for="name">Event Name<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="name" id="name"
                                class="form-control custInput @error('name') is-invalid @enderror" type="text"
                                name="name" autocomplete="off" placeholder="Event Name" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 g-4 pt-3">
                        {{-- Description --}}
                        <div class="form-group col">
                            <label for="description">Description</label>
                            <input wire:model="description" id="description"
                                class="form-control custInput @error('description') is-invalid @enderror" type="text"
                                name="description" autocomplete="off" placeholder="Description">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-lg-3 g-4 pt-3">
                        {{-- Venue --}}
                        <div class="form-group col">
                            <label for="venue">Venue<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="venue" id="venue"
                                class="form-control custInput @error('venue') is-invalid @enderror" type="text"
                                name="venue" autocomplete="off" placeholder="Venue" required>
                            @error('venue')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Starts At --}}
                        <div class="form-group col">
                            <label for="starts_at">Starts At<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="starts_at" id="starts_at"
                                class="form-control custInput @error('starts_at') is-invalid @enderror"
                                type="datetime-local" name="starts_at" autocomplete="off" placeholder="Starts At"
                                required style="cursor: text;">
                            @error('starts_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Ends At --}}
                        <div class="form-group col">
                            <label for="ends_at">Ends At<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="ends_at" id="ends_at"
                                class="form-control custInput @error('ends_at') is-invalid @enderror"
                                type="datetime-local" name="ends_at" autocomplete="off" placeholder="Ends At" required
                                style="cursor: text;">
                            @error('ends_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 g-4 pt-3">
                        {{-- Full Address --}}
                        <div class="form-group col">
                            <label for="address">Full Address<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="address" id="address"
                                class="form-control custInput @error('address') is-invalid @enderror" type="text"
                                name="address" autocomplete="off" placeholder="Full Address" required>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-lg-3 g-4 pt-3">
                        {{-- Barangay --}}
                        <div class="form-group col">
                            <label for="barangay">Barangay<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="barangay" id="barangay"
                                class="form-control custInput @error('barangay') is-invalid @enderror" type="text"
                                name="barangay" autocomplete="off" placeholder="Barangay" required>
                            @error('barangay')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- City --}}
                        <div class="form-group col">
                            <label for="city">City / Municipality<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="city" id="city"
                                class="form-control custInput @error('city') is-invalid @enderror" type="text"
                                name="city" autocomplete="off" placeholder="City / Municipality" required>
                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Province --}}
                        <div class="form-group col">
                            <label for="province">Province<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="province" id="province"
                                class="form-control custInput @error('province') is-invalid @enderror" type="text"
                                name="province" autocomplete="off" placeholder="Province" required>
                            @error('province')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-end pt-4">
                        <button type="submit" value="true" class="custBtn custBtn-green ms-3"><i
                                class="bi bi-pencil-fill"></i>&nbsp Save Changes</button>
                    </div>
                </form>
            </div>

            {{-- Open Registration --}}
            @if($event->status === "UPCOMING")
            <div class="px-1 mt-5">
                <h5 class="fw-bold">Open Registration</h5>
                <p>By proceeding, you are allowing coaches to join and register their lineup or team in this event.</p>

                <button wire:click="openRegistration" class="custBtn custBtn-green me-3">
                    <i style="display: inline-block;" class="bi bi-unlock-fill"></i>
                    &nbsp Open Registration
                </button>
            </div>
            @endif

            {{-- Start Event --}}
            @if($event->status === "REGISTRATION OPEN")
            <div class="px-1 mt-5">
                <h5 class="fw-bold">Start Event</h5>
                <p>Start this event and begin generating match pairings for each games.</p>

                <button wire:click="startEvent" class="custBtn custBtn-green me-3">
                    <i style="display: inline-block;" class="bi bi-play-circle"></i>
                    &nbsp Start Event
                </button>
            </div>
            @endif

            {{-- End Event --}}
            @if($event->status === "ONGOING")
            <div class="px-1 mt-5">
                <h5 class="fw-bold">Finish Event</h5>
                <p>Conclude and wrap up the event. Before proceeding, ensure that all games within this event have
                    already determined winners.</p>

                <button wire:click="endEvent" class="custBtn custBtn-red me-3">
                    <i style="display: inline-block;" class="bi bi-check-circle"></i>
                    &nbsp End Event
                </button>
            </div>
            @endif

            {{-- Cancel Event --}}
            @if(in_array($event->status, ["UPCOMING", "REGISTRATION OPEN"]))
            <div class="px-1 mt-5">
                <h5 class="fw-bold">Cancel Event</h5>
                <p>Proceeding will lead to the discontinuation of the scheduled event. This action cannot be undone,
                    please be sure before proceeding.</p>

                <a wire:navigate href="{{ route('events.cancel', ['event' => $this->event->id]) }}"
                    class="custBtn custBtn-red me-3">
                    <i style="display: inline-block;" class="bi bi-x-circle"></i>
                    &nbsp Cancel Event
                </a>
            </div>
            @endif

            {{-- Delete Event --}}
            @if(in_array($event->status, ["COMPLETED", "CANCELLED"]))
            <div class="px-1 mt-5">
                <h5 class="fw-bold">Delete Event</h5>
                <p>Once you delete an event, there is no turning back. Please be sure before proceeding.</p>

                <a wire:navigate href="{{ route('events.delete', ['event' => $this->event->id]) }}"
                    class="custBtn custBtn-red me-3">
                    <i style="display: inline-block;" class="bi bi-trash3-fill"></i>
                    &nbsp Delete Event
                </a>
            </div>
            @endif
        </div>
    </div>
</div>