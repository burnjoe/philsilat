<div>
   <div class="text-dark p-3">
      <div class="d-flex align-items-center">
         <h3 class="fw-bold mb-0">USER ACCOUNTS</h3>
      </div>
      <hr class="mb-0">
   </div>

   <div class="container">
      {{-- Alerts --}}
      @include('livewire.inc.alerts')

      <div class="container-fluid d-flex justify-content-between py-3">
         <div class="d-flex">
            {{-- Search --}}
            @include('livewire.inc.search')

            {{-- Clear all filters --}}
            @if($this->hasFilters())
            <div class="d-flex align-items-center">
               <a class="nav-link" style="color: #dc3545; cursor: pointer;" wire:click="clearAllFilters">
                  <i class="bi bi-x-circle-fill"></i>
                  <span style="text-decoration: underline;">
                     Clear all filters
                  </span>
               </a>
            </div>
            @endif
         </div>

         <div style="white-space: nowrap;">
            <a wire:navigate href="{{ route('accounts.index') }}" class="custBtn custBtn-light ms-3"><i
                  class="bi bi-card-list"></i>&nbsp
               Signup Codes &nbsp<i
               class="bi bi-arrow-right"></i></a>
         </div>
      </div>

      <div class="mx-3 mb-3 bg-white" style="overflow-x: auto; box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
         <table class="table table-striped table-hover mb-0">
            <thead class="table-dark text-light" style="white-space: nowrap;">
               <th scope="col">Last Name</th>
               <th scope="col">First Name</th>
               <th scope="col">
                  <ul class="navbar-nav ms-auto me-2">
                     <li class="nav-item dropdown" wire:click.away="closeSexDropdown">
                        <a wire:click="toggleSexDropdown" class="nav-link dropdown-toggle py-0" role="button"
                           aria-expanded="{{ $isSexDropdownOpen ? 'true' : 'false' }}">
                           Sex
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark"
                           style="{{ $isSexDropdownOpen ? 'display: block;' : 'display: none;' }}">
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedSexes" class="form-check-input me-1"
                                    type="checkbox" value="Male" id="male">
                                 <label class="form-check-label fs-6 fw-normal" for="male">Male</label>
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedSexes" class="form-check-input me-1"
                                    type="checkbox" value="Female" id="female">
                                 <label class="form-check-label fs-6 fw-normal" for="female">Female</label>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </th>
               <th scope="col">Email</th>
               <th scope="col">Phone</th>
               <th scope="col">
                  <ul class="navbar-nav ms-auto me-2">
                     <li class="nav-item dropdown" wire:click.away="closeRoleDropdown">
                        <a wire:click="toggleRoleDropdown" class="nav-link dropdown-toggle py-0" role="button"
                           aria-expanded="{{ $isRoleDropdownOpen ? 'true' : 'false' }}">
                           Role
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark"
                           style="{{ $isRoleDropdownOpen ? 'display: block;' : 'display: none;' }}">
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedRoles" class="form-check-input me-1"
                                    type="checkbox" value="Admin" id="admin">
                                 <label class="form-check-label fs-6 fw-normal" for="admin">Admin</label>
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedRoles" class="form-check-input me-1"
                                    type="checkbox" value="Coach" id="coach">
                                 <label class="form-check-label fs-6 fw-normal" for="coach">Coach</label>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </th>
               <th scope="col">
                  <ul class="navbar-nav ms-auto me-2">
                     <li class="nav-item dropdown" wire:click.away="closeStatusDropdown">
                        <a wire:click="toggleStatusDropdown" class="nav-link dropdown-toggle py-0" role="button"
                           aria-expanded="{{ $isStatusDropdownOpen ? 'true' : 'false' }}">
                           Status
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark"
                           style="{{ $isStatusDropdownOpen ? 'display: block;' : 'display: none;' }}">
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedStatuses" class="form-check-input me-1"
                                    type="checkbox" value="ACTIVE" id="active">
                                 <label class="form-check-label fs-6 fw-normal" for="active">Active</label>
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedStatuses" class="form-check-input me-1"
                                    type="checkbox" value="INACTIVE" id="inactive">
                                 <label class="form-check-label fs-6 fw-normal" for="inactive">Inactive</label>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </th>
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
                        @if ($user->status == 'ACTIVE')
                           <span class="badge text-bg-success">{{ $user->status }}</span>
                        @elseif($user->status == 'INACTIVE')
                           <span class="badge text-bg-secondary">{{ $user->status }}</span>
                        @endif
                     </td>

                     <td>
                        <div style="white-space: nowrap;">
                           <a wire:navigate href="{{ route('accounts.edit', ['user' => $user->id]) }}"
                              class="custBtn custBtn-light" style="display: inline-block; margin-right: 8px;"><i
                                 class="bi bi-pencil-fill"></i>&nbsp
                              Edit</a>

                           <a wire:navigate href="{{ route('accounts.delete', ['user' => $user->id]) }}"
                              class="custBtn custBtn-red ms-3"><i style="display: inline-block;"
                                 class="bi bi-trash3-fill"></i>&nbsp Delete</a>
                        </div>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>

         {{-- No Records Found --}}
         @if ($users->total() == 0)
            <div class="d-flex justify-content-center align-items-center my-5">
               @if (empty($search))
                  <h4>No existing records.</h4>
               @else
                  <h4>No records found for matching "{{ $search }}".</h4>
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
