<div>
    <div class="text-dark px-3 pt-3">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h3 class="fw-bold mb-0">
                    {{ $event->name }}
                </h3>
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
                            <a class="nav-link ps-1"
                                href="{{ route('events.show', ['event' => $event->id]) }}">Games</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events.teams', ['event' => $event->id]) }}">Teams</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('events.settings', ['event' => $event->id]) }}">Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <div class="pe-1 py-2">
                        <a href="{{ route('events') }}" class="custBtn custBtn-light"><i
                                class="bi bi-arrow-left"></i>&nbsp
                            Back to All Events</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>