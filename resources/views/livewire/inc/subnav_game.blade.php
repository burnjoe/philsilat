<div>
   <div class="text-dark px-3 pt-3">
      <div class="d-flex justify-content-between">
         <div class="d-flex align-items-center">
            <h3 class="fw-bold mb-0">
               {{ $game->name }}
            </h3>
            <span class="badge text-bg-primary py-1 ms-3">CLASS {{ $game->category->class_label }}</span>
            <span class="badge text-bg-secondary py-1 ms-2">{{ strtoupper($game->category->sex) }} CATEGORY</span>
         </div>
      </div>
      <hr class="mb-0">
   </div>

   <div class="container text-dark pb-3">
      <nav class="navbar navbar-expand navbar-light">
         <div class="container-fluid d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a class="nav-link ps-1" wire:navigate
                        href="{{ route('games.matches', ['event' => $event->id, 'game' => $game->id]) }}">Matches</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" wire:navigate
                        href="{{ route('games.athletes', ['event' => $event->id, 'game' => $game->id]) }}">Athletes</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" wire:navigate
                        href="{{ route('games.settings', ['event' => $event->id, 'game' => $game->id]) }}">Settings</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('export_match_results_pdf') }}" target="_blank">Match
                        Results</a>
                  </li>
               </ul>
            </div>
            <div class="d-flex flex-row align-items-center">
               <div class="pe-1 py-2">
                  <a wire:navigate href="{{ route('events.show', ['event' => $event->id]) }}"
                     class="custBtn custBtn-light"><i class="bi bi-arrow-left"></i>&nbsp Back to All Games</a>
               </div>
            </div>
         </div>
      </nav>
   </div>
</div>
