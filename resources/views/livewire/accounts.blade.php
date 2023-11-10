<div>

    <div class="text-dark p-3">
        <div class="d-flex align-items-center">
            <h3 class="fw-bold mb-0">USER ACCOUNTS</h3>
        </div>
    </div>

    <div class="container">
        {{-- Alerts --}}
        @include('livewire.inc.alerts')

        <div class="container-fluid d-flex justify-content-between py-3">
            {{-- Search --}}
            @include('livewire.inc.search')
            
            <div style="white-space: nowrap;">
                <a href="{{ route('accounts.index') }}" class="custBtn custBtn-light ms-3"><i
                        class="bi bi-card-list"></i>&nbsp Signup Codes</a>
            </div>
        </div>

        <div class="mx-3 mb-3 bg-white" style="overflow-x: auto; box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark text-light" style="white-space: nowrap;">
                    <th scope="col">Last Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr scope="row" wire:key="{{ $user->id }}">
                        <td>{{ $user->profileable->last_name }}</td>
                        <td>{{ $user->profileable->first_name }}</td>
                        <td>{{ $user->profileable->sex }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->profileable->phone }}</td>
                        <td>{{ ucwords($user->getRoleNames()->first()) }}</td>
                        <td>
                            @if($user->status == 'ACTIVE')
                            <span class="badge text-bg-success">{{ $user->status }}</span>
                            @elseif($user->status == 'INACTIVE')
                            <span class="badge text-bg-secondary">{{ $user->status }}</span>
                            @endif
                        </td>

                        <td>
                            <div style="white-space: nowrap;">
                                <a href="{{ route('accounts.edit', ['user' => $user->id]) }}"
                                    class="custBtn custBtn-light" style="display: inline-block; margin-right: 8px;"><i
                                        class="bi bi-pencil-fill"></i>&nbsp
                                    Edit</a>

                                <a href="{{ route('accounts.delete', ['user' => $user->id]) }}"
                                    class="custBtn custBtn-red ms-3"><i style="display: inline-block;"
                                        class="bi bi-trash3-fill"></i>&nbsp Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- No Records Found --}}
            @if($users->total() == 0)
            <div class="d-flex justify-content-center align-items-center my-5">
                @if(empty($search))
                <h4>No existing records.</h4>
                @else
                <h4>No records found for matching "{{$search}}".</h4>
                @endif
            </div>
            @endif
        </div>

        {{-- Pagination Links --}}
        <div class="mx-3 mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>