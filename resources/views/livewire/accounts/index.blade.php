<div>
   <div class="text-dark p-3">
      <div class="d-flex align-items-center">
         <h3 class="fw-bold mb-0">SIGNUP CODES</h3>
      </div>
      <hr class="mb-0">
   </div>

   <div class="container">
      {{-- Form --}}
      <div class="container-fluid text-dark py-3 mb-3">
         <div class="p-4"
            style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
            <div class="d-flex align-items-center mb-2">
               <h5 class="fw-bold">Generate Signup Codes</h5>
            </div>

            <form wire:submit.prevent="store">
               <div class="row row-cols-1 row-cols-lg-2 g-4">
                  {{-- Number of Codes to Generate --}}
                  <div class="form-group col">
                     <label for="num_codes">Number of Signup Codes<span style="color: #b63e3e;"> *</span></label>
                     <input wire:model="num_codes" id="num_codes"
                        class="form-control custInput @error('num_codes') is-invalid @enderror" type="number"
                        name="num_codes" minlength="2" autocomplete="off" placeholder="Number of Signup Codes" required
                        autofocus>
                     @error('num_codes')
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

               {{-- Submit --}}
               <div class="form-group d-flex justify-content-end pt-4">
                  <button type="submit" value="true" class="custBtn custBtn-green ms-3"><i
                        class="bi bi-gear"></i>&nbsp Generate Signup Codes</button>
               </div>
            </form>
         </div>
      </div>

      {{-- Alerts --}}
      @include('livewire.inc.alerts')

      {{-- Search and Back --}}
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
            <a wire:navigate href="{{ route('accounts') }}" class="custBtn custBtn-light"><i
                  class="bi bi-arrow-left"></i>&nbsp
               Back to User Accounts</a>
         </div>
      </div>

      {{-- Table --}}
      <div class="mx-3 mb-3 bg-white" style="overflow-x: auto; box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
         <table class="table table-striped table-hover mb-0">
            <thead class="table-dark text-light" style="white-space: nowrap;">
               <th scope="col">Signup Code</th>
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
               <th scope="col">Created At</th>
            </thead>
            <tbody>
               @foreach ($codes as $code)
                  <tr scope="row" wire:key="{{ $code->id }}">
                     <td>{{ $code->code }}</td>
                     <td>{{ ucwords($code->role) }}</td>
                     <td>{{ $code->created_at }}</td>
                  </tr>
               @endforeach
            </tbody>
         </table>

         {{-- No Records Found --}}
         @if ($codes->total() == 0)
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
         {{ $codes->links() }}
      </div>
   </div>
</div>
