<div>
    <div class="text-dark p-3">
        <h3 class=" fw-bold">EDIT USER ACCOUNT</h3>
        <hr class="mb-0">
    </div>

    <div class="container">
        <div class="container-fluid text-dark py-3">
            <div class="p-4"
                style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">

                <form wire:submit.prevent="update">
                    <div class="d-flex align-items-center mb-2">
                        <h5 class="fw-bold">Personal Information</h5>
                    </div>
                    <div class="row row-cols-1 row-cols-lg-2 g-4">
                        {{-- Last Name --}}
                        <div class="form-group col">
                            <label for="last_name">Last Name<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="last_name" id="last_name"
                                class="form-control custInput @error('last_name') is-invalid @enderror" type="text"
                                name="last_name" minlength="2" autocomplete="off" placeholder="Last Name" required
                                autofocus>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- First Name --}}
                        <div class="form-group col">
                            <label for="first_name">First Name<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="first_name" id="first_name"
                                class="form-control custInput @error('first_name') is-invalid @enderror" type="text"
                                name="first_name" minlength="2" autocomplete="off" placeholder="First Name" required>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-lg-2 g-4 pt-3">
                        {{-- Phone --}}
                        <div class="form-group col">
                            <label for="phone">Phone Number<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="phone" id="phone"
                                class="form-control custInput @error('phone') is-invalid @enderror" type="text"
                                name="phone" minlength="11" autocomplete="off" placeholder="Phone Number" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Sex --}}
                        <div class="form-group col">
                            <label for="sex">Sex<span style="color: #b63e3e;"> *</span></label>
                            <select wire:model="sex" id="sex" name="sex"
                                class="form-select custFormSelect @error('sex') is-invalid @enderror"
                                aria-label=".form-select example" required>
                                <option class="custOption" hidden>Sex</option>
                                <option class="custOption" value="Male">Male</option>
                                <option class="custOption" value="Female">Female</option>
                            </select>
                            @error('sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex align-items-center pt-5 mb-2">
                        <h5 class="fw-bold">User Account Information</h5>
                    </div>

                    <div class="row row-cols-1 row-cols-lg-2 g-4">
                        {{-- Email --}}
                        <div class="form-group row-1 col">
                            <label for="email">Email<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="email" id="email"
                                class="form-control custInput @error('email') is-invalid @enderror" type="email"
                                name="email" autocomplete="off" placeholder="Email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="form-group col">
                            <label for="role">Role<span style="color: #b63e3e;"> *</span></label>
                            <select wire:model="role" id="role" name="role"
                                class="form-select custFormSelect @error('role') is-invalid @enderror"
                                aria-label=".form-select example" required>
                                <option class="custOption" hidden>Role</option>
                                <option class="custOption" value="Admin">Admin</option>
                                <option class="custOption" value="Coach">Coach</option>
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-lg-2 g-4 pt-3">
                        {{-- New Password --}}
                        <div class="form-group row-1 col">
                            <label for="password">New Password</label>
                            <input wire:model="password" id="password"
                                class="form-control custInput @error('password') is-invalid @enderror" type="password"
                                name="password" minlength="8" autocomplete="off" placeholder="New Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="form-group col">
                            <label for="status">Status<span style="color: #b63e3e;"> *</span></label>
                            <select wire:model="status" id="status" name="status"
                                class="form-select custFormSelect @error('status') is-invalid @enderror"
                                aria-label=".form-select example" required>
                                <option class="custOption" hidden>Status</option>
                                <option class="custOption" value="ACTIVE">ACTIVE</option>
                                <option class="custOption" value="INACTIVE">INACTIVE</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-lg-2 g-4 pt-3">
                        {{-- Confirm Password --}}
                        <div class="form-group row-1 col">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" class="form-control custInput" type="password"
                                name="password_confirmation" minlength="8" autocomplete="off"
                                placeholder="Confirm Password">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="form-group d-flex justify-content-end pt-4">
                        <a wire:navigate href="{{ route('accounts') }}" class="custBtn custBtn-light">Cancel</a>
                        <button type="submit" value="true" class="custBtn custBtn-green ms-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>