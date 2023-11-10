<div>
    <div class="container text-dark py-3">
        <h3 class="fw-bold">CHANGE PASSWORD</h3>
        <hr class="mb-0">
    </div>

    <div class="container text-dark py-3">
        <div class="p-4"
            style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">

            <form action="#" method="POST">
                {{-- Current Password --}}
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="form-group col">
                        <label for="current_password">Current Password<span style="color: #b63e3e;"> *</span></label>
                        <input id="current_password" type="password"
                            class="form-control custInput @error('current_password') is-invalid @enderror"
                            name="current_password" required placeholder="Current Password" autofocus>
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- New Password --}}
                <div class="row row-cols-1 row-cols-sm-2 g-4 mt-1">
                    <div class="form-group col">
                        <label for="password">New Password<span style="color: #b63e3e;"> *</span></label>
                        <input id="password" type="password"
                            class="form-control custInput @error('password') is-invalid @enderror" name="password"
                            required placeholder="New Password" autofocus>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="row row-cols-1 row-cols-sm-2 g-4 mt-1">
                    <div class="form-group col">
                        <label for="password-confirm">Confirm Password<span style="color: #b63e3e;"> *</span></label>
                        <input id="password-confirm" type="password"
                            class="form-control custInput @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" required placeholder="Confirm Password" autofocus>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group d-flex justify-content-end pt-4">
                    <button type="submit" class="custBtn custBtn-light">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>