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
                    <h1 class="h1Dark mb-5">LOGIN</h1>

                    <form action="#" class="form-login" method="POST">
                        @csrf

                        <div class="form-group mt-3">
                            <input type="text" class="form-control custInput @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required placeholder="Email" autofocus>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password"
                                class="form-control custInput @error('password') is-invalid @enderror" name="password"
                                value="{{ old('password') }}" required placeholder="Password" autofocus>
                        </div>
                        <div class="row flex-row mt-3">
                            <div class="col">
                                <div class="text-start">
                                    <a href="#" class="custText custText-clickable">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-btn d-flex justify-content-end">
                                    <button type="submit" value="LOGIN" name="login_mobile"
                                        class="custBtn custBtn-gray">LOGIN</button>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <p class="custText">
                                Don't have an account yet?
                                <a href="{{ route('register') }}" class="custText custText-clickable">
                                    <strong>Sign Up</strong>
                                </a>
                            </p>
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
                <h1 class="h1Dark mb-5">LOGIN</h1>

                <form action="#" class="form-login" method="POST">
                    @csrf

                    <div class="form-group mt-3">
                        <input type="text" class="form-control custInput @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required placeholder="Email" autofocus>
                    </div>
                    <div class="form-group mt-3">
                        <input type="password" class="form-control custInput @error('password') is-invalid @enderror"
                            name="password" value="{{ old('password') }}" required placeholder="Password" autofocus>
                    </div>
                    <div class="row flex-row mt-3">
                        <div class="col">
                            <div class="text-start">
                                <a href="#" class="custText custText-clickable">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-btn d-flex justify-content-end">
                                <button type="submit" value="LOGIN" name="login_desktop"
                                    class="custBtn custBtn-gray">LOGIN</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <p class="custText">
                            Don't have an account yet?
                            <a href="{{ route('register') }}" class="custText custText-clickable">
                                <strong>Sign Up</strong>
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
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email
                                    Address')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                            old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>