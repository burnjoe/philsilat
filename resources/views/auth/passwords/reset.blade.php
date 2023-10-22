<x-app-layout>
    <div class="row flex-row height-full">
        {{-- Left Panel --}}
        <div class="col col-md-6 bg-body-secondary d-flex justify-content-center align-items-center">
            {{-- MOBILE --}}
            <div class="container-fluid d-none d-md-block">
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('img/philsilat_logo.png') }}" alt="" height="180px" width="140px">
                </div>
                <h1 class="h1Light">PHILSILAT</h1>
                <p class="pLight pLight-lg">EVENT MANAGEMENT SYSTEM</p>
            </div>
            <div class="card card-body bg-dark m-4 d-sm-flex d-md-none">
                <div class="container-fluid m-4 w-auto">
                    <h1 class="h1Dark mb-4">RESET PASSWORD</h1>

                    {{-- Validation Errors --}}
                    @if($errors->any())
                    <div class='alert alert-danger p-2 fs-sm'>
                        <ul class="ps-4 mb-0">
                            @foreach ($errors->all() as $error)
                            <li class="text-justify">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('password.update') }}" class="form-login" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- Email --}}
                        <div class="form-group mt-3">
                            <input type="text" class="form-control custInput @error('email') is-invalid @enderror"
                                name="email" value="{{ $email ?? old('email') }}" required placeholder="Email">
                        </div>
                        {{-- Password --}}
                        <div class="form-group mt-3">
                            <input type="password"
                                class="form-control custInput @error('password') is-invalid @enderror" name="password"
                                value="{{ old('password') }}" required placeholder="New Password" autofocus>
                        </div>
                        {{-- Confirm Password --}}
                        <div class="form-group mt-3">
                            <input id="password-confirm" type="password" class="form-control custInput"
                                name="password_confirmation" required placeholder="Confirm Password" autofocus>
                        </div>
                        {{-- Submit --}}
                        <div class="row flex-row mt-3">
                            <div class="col">
                                <div class="form-btn d-flex justify-content-end">
                                    <button type="submit" value="LOGIN" name="login_desktop"
                                        class="custBtn custBtn-gray">RESET PASSWORD</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End of Left Panel --}}

        {{-- Right Panel --}}
        <div class="col-6 bg-dark d-none d-md-flex justify-content-center align-items-center">
            {{-- DESKTOP --}}
            <div class="container-fluid col-6 my-5">
                <h1 class="h1Dark mb-4">RESET PASSWORD</h1>

                {{-- Validation Errors --}}
                @if($errors->any())
                <div class='alert alert-danger p-2 fs-sm'>
                    <ul class="ps-4 mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('password.update') }}" class="form-login" method="POST">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div class="form-group mt-3">
                        <input type="text" class="form-control custInput @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required placeholder="Email">
                    </div>
                    {{-- Password --}}
                    <div class="form-group mt-3">
                        <input type="password" class="form-control custInput @error('password') is-invalid @enderror"
                            name="password" required placeholder="New Password" autofocus>
                    </div>
                    {{-- Confirm Password --}}
                    <div class="form-group mt-3">
                        <input id="password-confirm" type="password" class="form-control custInput"
                            name="password_confirmation" required placeholder="Confirm Password" autofocus>
                    </div>
                    {{-- Submit --}}
                    <div class="row flex-row mt-3">
                        <div class="col">
                            <div class="form-btn d-flex justify-content-end">
                                <button type="submit" value="LOGIN" name="login_desktop"
                                    class="custBtn custBtn-gray">RESET PASSWORD</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>