<div>
   {{-- Sub Navigation --}}
   @include('livewire.inc.subnav_event')

   <div class="container text-dark py-3 px-1">
      {{-- Alerts --}}
      @include('livewire.inc.alerts')

      {{-- Team Name --}}
      <div class="container-fluid d-flex justify-content-between mb-1 pt-3">
         <div class="px-3">
            {{-- Team Name Data --}}
            <h5 class="fw-bold">Team 
               Rempel, Harber and Dickinson
            </h5>
         </div>
      </div>

      {{-- Coach Section --}}
      <div class="container-fluid d-flex justify-content-between mb-3 pt-3">
         <div class="px-3">
            <h5 class="fw-bold">Coaches</h5>
         </div>
      </div>

      <div class="mx-4 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
         <table class="table table-striped table-hover mb-0">
            <thead class="table-dark text-light">
               <th scope="col">Last Name</th>
               <th scope="col">First Name</th>
               <th scope="col">Sex</th>
               <th scope="col">Phone Number</th>
            </thead>
            <tbody>
               {{-- Coach data --}}
               @foreach ($teams as $team)
                  <tr scope="row" wire:key="{{ $team->id }}">
                     <td>Derla</td>
                     <td>Julius</td>
                     <td>Male</td>
                     <td>09123456789</td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>

      <div class="px-4 my-5">
         <hr class="text-dark">
      </div>

      {{-- Athletes Section --}}
      <div class="container-fluid d-flex justify-content-between mb-3">
         <div class="px-3">
            <h5 class="fw-bold">Athletes</h5>
         </div>
         <div class="d-flex justify-content-end col">
            {{-- Search --}}
            @include('livewire.inc.search')
         </div>
      </div>

      {{-- Athletes Table --}}
      <div class="mx-4 mb-3 bg-white" style="overflow-x: auto;  box-shadow: 0px 5px 8px 0 rgba(0, 0, 0, 0.2);">
         <table class="table table-striped table-hover mb-0">
            <thead class="table-dark text-light">
               <th scope="col">Last Name</th>
               <th scope="col">First Name</th>
               <th scope="col">Birthdate</th>
               <th scope="col">Sex</th>
               <th scope="col">Weight (kg)</th>
               <th scope="col">School</th>
               <th scope="col">Grade Level</th>
            </thead>
            <tbody>
               {{-- Atheletes Data --}}
               @foreach ($teams as $team)
                  <tr scope="row" wire:key="{{ $team->id }}">
                     <td>Ferreras</td>
                     <td>Vince Austin</td>
                     <td>2001-03-09</td>
                     <td>Male</td>
                     <td>70</td>
                     <td>PNC</td>
                     <td>12</td>
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
