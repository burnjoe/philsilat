<x-app-layout>
    <div class="row flex-row height-full">
        {{-- Left Panel --}}
        <div class="col col-md-6 bg-body-secondary d-flex justify-content-center align-items-center">
            {{-- MOBILE --}}
            <div class="container-fluid d-none d-md-block">
                <h1 class="h1Light">PHILSILAT</h1>
                <p class="pLight pLight-lg">EVENT MANAGEMENT SYSTEM</p>
            </div>
            <div class="card card-body bg-dark m-4 d-sm-flex d-md-none">
                <div class="container-fluid m-4 w-auto">
                    <h1 class="h1Dark mb-5">SIGN UP</h1>

                    <form action="#" class="form-login" method="POST">
                        @csrf


                    </form>
                </div>
            </div>
        </div>
        {{-- End of Left Panel --}}

        {{-- Right Panel --}}
        <div class="col-6 bg-dark d-none d-md-flex justify-content-center align-items-center">
            {{-- DESKTOP --}}
            <div class="container-fluid col-6 my-5">
                <h1 class="h1Dark mb-5">SIGN UP</h1>

                @if($errors->any())
                    <div class='alert alert-danger p-2 mt-5 fs-sm'>
                        <ul class="ps-4 mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="text-justify">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="#" class="form-login" method="POST">
                    @csrf

                    {{-- Last Name & First Name --}}
                    <div class="row flex-row mt-3">
                        <div class="form-group col-6 pe-1">
                            <input id="last_name" type="text"
                                class="form-control custInput @error('last_name') is-invalid @enderror" name="last_name"
                                value="{{ old('last_name') }}" required placeholder="Last Name" autofocus>
                        </div>
                        <div class="form-group col-6 ps-1">
                            <input id="first_name" type="text"
                                class="form-control custInput @error('first_name') is-invalid @enderror"
                                name="first_name" value="{{ old('first_name') }}" required placeholder="First Name"
                                autofocus>
                        </div>
                    </div>
                    {{-- Phone Number and Sex --}}
                    <div class="row flex-row mt-3">
                        <div class="form-group col-6 pe-1">
                            <input id="phone" type="text"
                                class="form-control custInput @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required placeholder="Phone Number" autofocus>
                        </div>
                        <div class="form-group col-6 ps-1">
                            <select name="sex" class="form-select custFormSelect" aria-label=".form-select example"
                                required>
                                <option class="custOption" value="" hidden>Sex</option>
                                <option class="custOption" @if(old('sex')==='Male' ) selected @endif value="Male">Male
                                </option>
                                <option class="custOption" @if(old('sex')==='Female' ) selected @endif value="Female">
                                    Female</option>
                            </select>
                        </div>
                    </div>
                    {{-- Email --}}
                    <div class="form-group mt-3">
                        <input id="email" type="email"
                            class="form-control custInput @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required placeholder="Email" autofocus>
                    </div>
                    {{-- Password --}}
                    <div class="form-group mt-3">
                        <input id="password" type="password"
                            class="form-control custInput @error('password') is-invalid @enderror" name="password"
                            value="{{ old('password') }}" required placeholder="Password" autofocus>
                    </div>
                    {{-- Confirm Password --}}
                    <div class="form-group mt-3">
                        <input id="password-confirm" type="password"
                            class="form-control custInput @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" value="{{ old('password_confirmation') }}" required
                            placeholder="Confirm Password" autofocus>
                    </div>
                    {{-- Code --}}
                    <div class="form-group mt-3">
                        <input id="code" type="text" class="form-control custInput @error('code') is-invalid @enderror"
                            name="code" value="{{ old('code') }}" required placeholder="Signup Code" autofocus>
                    </div>
                    {{-- Button --}}
                    <div class="form-btn d-flex justify-content-end mt-3">
                        <button type="submit" value="SIGN UP" class="custBtn custBtn-gray">SIGN UP</button>
                        <!-- <input type="submit" value="SIGN UP" name="signup_desktop" class="custBtn custBtn-gray"> -->
                    </div>
                    <div class="text-center mt-5">
                        <p class="custText">
                            Already have an account?
                            <a href="{{ route('login') }}" class="custText custText-clickable">
                                <strong>Login</strong>
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>








    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                    Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>