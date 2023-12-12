<div>
    <div class="text-dark p-3">
        <h3 class="fw-bold">PROFILE</h3>
        <hr class="mb-0">
    </div>

    <div class="container text-dark py-3 px-1">
        <div class="row g-4 p-3">
            <div class="col-12">
                <div class="card" style="overflow: hidden; background-color: white;">
                    <div class="header d-flex align-items-center h-100 p-4 bg-audience">
                        <div class="mx-auto">
                            <img class="object-fit-fill border rounded-circle" src="{{ asset('img/user_icon.png') }}"
                                alt="" height="150px" width="150px">
                            <div class="text-light text-center fw-normal mt-2" style="font-size: 18px;">
                                @php 
                                $user = auth()->user();
                                $role = ucwords($user->getRoleNames()->first());
                                @endphp
                                {{ $user->profileable->first_name . ' ' . $user->profileable->last_name }}
                            </div>
                            <div class="text-light text-center fw-normal" style="font-size: 14px;">
                                {{ $role }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-2 px-3">
                            <div class="col">
                                <div>
                                    <p class="fw-bold mb-0">Email Address:</p>
                                    <p>{{ $user->email }}</p>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0">Sex:</p>
                                    <p>{{ $user->profileable->sex }}</p>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0">Status:</p>
                                    @if($user->status == "ACTIVE")
                                    <p class="badge text-bg-success py-1">{{ $user->status }}</p>
                                    @else
                                    <p class="badge text-bg-secondary py-1">{{ $user->status }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <p class="fw-bold mb-0">Phone Number:</p>
                                    <p>{{ $user->profileable->phone }}</p>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0">Account Type:</p>
                                    <p>{{ $role }}</p>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0">Account Created At:</p>
                                    <p>{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>