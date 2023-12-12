<div>
    <div class="text-dark p-3">
        <h3 class=" fw-bold">{{ $team->exists ? 'DROP TEAM' : 'DROP ALL TEAMS'}}</h3>
        <hr class="mb-0">
    </div>

    <div class="container">
        <div class="container-fluid text-dark py-3">
            <div class="p-4"
                style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">

                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-circle-fill text-danger fs-1"></i>
                    @if($team->exists)
                    <span class="fs-4 ms-4">Are you sure to drop this team including its athletes?</span>
                    @else
                    <span class="fs-4 ms-4">Are you sure to drop all the teams including its athletes?</span>
                    @endif
                </div>

                <form wire:submit.prevent="{{ $team->exists ? 'destroy' : 'destroyAll'}}">
                    <div class="form-group d-flex justify-content-end pt-4">
                        <a wire:navigate href="{{ route('events.teams', ['event' => $event->id]) }}"
                            class="custBtn custBtn-light">Cancel</a>
                        <button type="submit" value="true" class="custBtn custBtn-red ms-3">Drop</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>