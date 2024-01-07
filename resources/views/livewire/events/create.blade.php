<div>
    <div class="text-dark p-3">
        <h3 class=" fw-bold">ADD EVENT</h3>
        <hr class="mb-0">
    </div>

    <div class="container">
        <div class="container-fluid text-dark py-3">
            <div class="p-4"
                style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                <form wire:submit.prevent="store">
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
                        {{-- Registration Starts At --}}
                        <div class="form-group col">
                            <label for="registration_starts_at">Registration Starts At<span style="color: #b63e3e;">
                                    *</span></label>
                            <input wire:model="registration_starts_at" id="registration_starts_at"
                                class="form-control custInput @error('registration_starts_at') is-invalid @enderror"
                                type="datetime-local" name="registration_starts_at" autocomplete="off"
                                placeholder="Starts At" required style="cursor: text;">
                            @error('registration_starts_at')
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

                    <div class="row g-4 pt-3">
                        {{-- Venue --}}
                        <div class="form-group col-12 col-lg-4">
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

                        {{-- Full Address --}}
                        <div class="form-group col-12 col-lg-8">
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
                        <a wire:navigate href="{{ route('events') }}" class="custBtn custBtn-light">Cancel</a>
                        <button type="submit" value="true" class="custBtn custBtn-green ms-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>