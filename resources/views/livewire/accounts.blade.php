<div>
    <div class="text-dark p-3">
        <div class="d-flex align-items-center">
            <h3 class="fw-bold mb-0">USER ACCOUNTS</h3>
        </div>
        <hr class="mb-0">
    </div>

    {{-- Alerts --}}
    @include('livewire.inc.alerts')

    <div class="d-flex justify-content-between mx-4 py-3">
        <div class="d-flex align-items-center">
            <input wire:model.live.debounce.300ms="search" class="form-control custInput" type="text" name="search"
                placeholder="Search" autocomplete="off">
            <i class="bi bi-search ms-2" aria-hidden="true"></i>
        </div>
        <div style="white-space: nowrap;">
            <button wire:click.prevent="index" name="action" class="custBtn custBtn-light ms-3"><i
                    class="bi bi-card-list"></i>&nbsp Signup Codes</button>
        </div>
    </div>

    <div class="mx-4 mb-3 bg-white" style="overflow-x: auto; box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark text-light" style="white-space: nowrap;">
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
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
                            <button wire:click.prevent="edit({{$user->id}})" class="custBtn custBtn-light"
                                style="display: inline-block; margin-right: 8px;"><i class="bi bi-pencil-fill"></i>&nbsp
                                Edit</button>

                            <button wire:click.prevent="delete({{$user->id}})" class="custBtn custBtn-red ms-3"><i
                                    style="display: inline-block;" class="bi bi-trash3-fill"></i>&nbsp Delete</button>
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
    <div class="mx-4 mt-4">
        {{ $users->links() }}
    </div>
</div>