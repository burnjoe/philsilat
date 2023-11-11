<div>
   @php
      $statusColor = [
          'UPCOMING' => 'primary',
          'REGISTRATION OPEN' => 'success',
          'CANCELLED' => 'danger',
          'ONGOING' => 'warning',
          'COMPLETED' => 'success',
      ];
   @endphp

   <div class="text-dark p-3">
      <div class="d-flex align-items-center">
         <h3 class="fw-bold mb-0">EVENTS</h3>
      </div>
      <hr class="mb-0">
   </div>

   <div class="container">
      {{-- Alerts --}}
      @include('livewire.inc.alerts')

      {{-- Search, Filter, and Add Button --}}
      <div class="container-fluid d-flex justify-content-between py-3">
         {{-- Search --}}
         @include('livewire.inc.search')

         <div class="d-flex" style="white-space: nowrap;">
            {{-- Filter by status --}}
            <div class="d-flex align-items-center" style="justify-content: flex-end;">
               <ul class="navbar-nav ms-auto me-2">
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <i class="bi bi-filter-right"></i>
                        Filter by:
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li>
                           <a class="dropdown-item">
                              <input class="form-check-input me-1" type="checkbox" value="" id="registrationOpen">
                              <label class="form-check-label fs-6 fw-normal" for="registrationOpen">Registration
                                 Open</label>
                           </a>
                        </li>
                        <li>
                           <a class="dropdown-item">
                              <input class="form-check-input me-1" type="checkbox" value="" id="upcoming">
                              <label class="form-check-label fs-6 fw-normal" for="upcoming">Upcoming</label>
                           </a>
                        </li>
                        <li>
                           <a class="dropdown-item">
                              <input class="form-check-input me-1" type="checkbox" value="" id="ongoing">
                              <label class="form-check-label fs-6 fw-normal" for="ongoing">Ongoing</label>
                           </a>
                        </li>
                        <li>
                           <a class="dropdown-item">
                              <input class="form-check-input me-1" type="checkbox" value="" id="completed">
                              <label class="form-check-label fs-6 fw-normal" for="completed">Completed</label>
                           </a>
                        </li>
                        <li>
                           <a class="dropdown-item">
                              <input class="form-check-input me-1" type="checkbox" value="" id="cancelled">
                              <label class="form-check-label fs-6 fw-normal" for="cancelled">Cancelled</label>
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>

            {{-- Add New Event Button --}}
            <a wire:navigate href="{{ route('events.create') }}" class="custBtn custBtn-light ms-3"><i class="bi bi-plus-lg"></i>&nbsp
               Add New Event</a>
         </div>
      </div>

      {{-- Events Card --}}
      @if ($events)
         <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 px-3 py-2">
            @foreach ($events as $event)
               <div wire:key="{{ $event->id }}" class="col" id="card-event">
                  <a class="nav-link" wire:navigate href="{{ route('events.show', ['event' => $event->id]) }}">
                     <div class="card" style="height:18rem;">
                        <div class="card-body rounded overflow-hidden p-3">
                           <span
                              class="badge text-bg-{{ $statusColor[$event->status] }} py-1 m-0">{{ $event->status }}</span>
                           <p class="d-flex justify-content-center mt-4 mb-0" style="font-size: 60px">
                              <i class="bi bi-calendar-event"></i>
                           </p>
                           <div class="d-flex justify-content-center align-items-center p-0 mb-5">
                              <h3 class="fs-5 fw-bold mb-0">{{ $event->name }} {{ $event->id }}</h3>
                           </div>
                           <p class="m-0" style="font-size: 14px"><small><b>Date:</b></small></p>
                           <p class="m-0" style="font-size: 14px">
                              {{ \Carbon\Carbon::parse($event->starts_at)->format('M.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    d, Y') }}
                           </p>
                        </div>
                     </div>
                  </a>
               </div>
            @endforeach
         </div>
      @endif

      {{-- No Records Found --}}
      @if ($events->total() == 0)
         <div class="d-flex justify-content-center align-items-center my-5">
            @if (empty($search))
               <h4>No existing events.</h4>
            @else
               <h4>No events found for matching "{{ $search }}".</h4>
            @endif
         </div>
      @endif

      {{-- Pagination Links --}}
      <div class="mx-3 mt-4">
         {{ $events->links() }}
      </div>
   </div>
</div>
