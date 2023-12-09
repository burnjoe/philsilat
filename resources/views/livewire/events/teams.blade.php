<div>
   {{-- Sub Navigation --}}
   @include('livewire.inc.subnav_event')

   <div class="container text-dark py-3 px-1">
      {{-- Alerts --}}
      @include('livewire.inc.alerts')

      <div class="container-fluid d-flex justify-content-between mb-3">
         <div class="px-3">
            <h5 class="fw-bold">Teams</h5>
         </div>
         <div class="d-flex justify-content-end col">
            {{-- Search --}}
            @include('livewire.inc.search')
            @if (in_array($event->status, ['REGISTRATION OPEN']) && $teams->isNotEmpty())
               <a wire:navigate href="{{ route('events.drop-all-teams', ['event' => $event->id]) }}"
                  class="custBtn custBtn-red me-3"><i class=" bi bi-arrow-down"></i>&nbsp Drop All Teams</a>
            @endif
         </div>
      </div>

      <div class="mx-4 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
         <table class="table table-striped table-hover mb-0">
            <thead class="table-dark text-light">
               <th scope="col">Team Name</th>
               <th scope="col">Coach 1</th>
               <th scope="col">Coach 2</th>
               <th scope="col">Action</th>
            </thead>
            <tbody>
               @foreach ($teams as $team)
                  <tr scope="row" wire:key="{{ $team->id }}">
                     <td>{{ $team->name }}</td>
                     {{-- coach 1 data --}}
                     <td></td>
                     {{-- coach 2 data --}}
                     <td></td>
                     <td>
                        <div style="white-space: nowrap;">
                           {{-- route --}}
                           <a wire:navigate
                              href="{{ route('events.view-team', ['event' => $event->id, 'team' => $team->id]) }}"
                              class="custBtn custBtn-light" style="display: inline-block; margin-right: 8px;"><i
                                 class="bi bi-eye-fill"></i>&nbsp
                              View</a>
                           @if (in_array($event->status, ['REGISTRATION OPEN']))
                              <a wire:navigate
                                 href="{{ route('events.drop-team', ['event' => $event->id, 'team' => $team->id]) }}"
                                 class="custBtn custBtn-red ms-3" style="display: inline-block; margin-right: 8px;"><i
                                    class=" bi bi-arrow-down"></i>
                                 Drop</a>
                           @endif
                        </div>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>

         {{-- No Records Found --}}
         @if ($teams->total() == 0)
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
         {{ $teams->links() }}
      </div>
   </div>
</div>
