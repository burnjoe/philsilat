<div>
   <div class="text-dark p-3">
      <div class="d-flex align-items-center">
         <h3 class="fw-bold mb-0">CATEGORIES</h3>
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
            <div class="d-flex align-items-center">
               <a href="#" class="nav-link" style="color: #dc3545;" wire:click="clearAllFilters">
                  <i class="bi bi-x-circle-fill"></i>
                  <span style="text-decoration: underline;">
                     Clear all filters
                  </span>
               </a>
            </div>
         </div>

         <div style="white-space: nowrap;">
            <a wire:navigate href="{{ route('categories.create') }}" class="custBtn custBtn-light ms-3"><i
                  class="bi bi-plus-lg"></i>&nbsp Add New Category</a>
         </div>
      </div>

      <div class="mx-3 mb-3 bg-white" style="overflow-x: auto; box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
         <table class="table table-striped table-hover mb-0">
            <thead class="table-dark text-light" style="white-space: nowrap;">
               <th scope="col">Class Label</th>
               <th scope="col">
                  <ul class="navbar-nav ms-auto me-2">
                     <li class="nav-item dropdown" wire:click.away="closeSexDropdown">
                        <a wire:click="toggleSexDropdown" class="nav-link dropdown-toggle py-0" role="button"
                           aria-expanded="{{ $isSexDropdownOpen ? 'true' : 'false' }}">
                           Sex Category
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark"
                           style="{{ $isSexDropdownOpen ? 'display: block;' : 'display: none;' }}">
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedSex" class="form-check-input me-1"
                                    type="checkbox" value="Male" id="male">
                                 <label class="form-check-label fs-6 fw-normal" for="male">Male</label>
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item">
                                 <input wire:model.live.debounce.300ms="selectedSex" class="form-check-input me-1"
                                    type="checkbox" value="Female" id="female">
                                 <label class="form-check-label fs-6 fw-normal" for="female">Female</label>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </th>
               <th scope="col">Min Weight (kg)</th>
               <th scope="col">Max Weight (kg)</th>
               <th scope="col">Action</th>
            </thead>
            <tbody>
               @foreach ($categories as $category)
                  <tr scope="row" wire:key="{{ $category->id }}">
                     <td>{{ $category->class_label }}</td>
                     <td>{{ $category->sex }}</td>
                     <td>{{ $category->min_weight }}</td>
                     <td>{{ $category->max_weight }}</td>
                     <td>
                        <div style="white-space: nowrap;">
                           <a wire:navigate href="{{ route('categories.edit', ['category' => $category->id]) }}"
                              class="custBtn custBtn-light" style="display: inline-block; margin-right: 8px;"><i
                                 class="bi bi-pencil-fill"></i>&nbsp
                              Edit</a>

                           <a wire:navigate href="{{ route('categories.delete', ['category' => $category->id]) }}"
                              class="custBtn custBtn-red ms-3"><i style="display: inline-block;"
                                 class="bi bi-trash3-fill"></i>&nbsp Delete</a>
                        </div>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>

         {{-- No Records Found --}}
         @if ($categories->total() == 0)
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
         {{ $categories->links() }}
      </div>
   </div>
</div>
