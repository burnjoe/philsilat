<div>
    <div class="text-dark px-3 pt-3">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h3 class="fw-bold mb-0">
                    {{ $game->name }} - Class {{ $game->category->class_label }} - {{ $game->category->sex }}
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
                                href="{{ route('games.matches', ['event' => $event->id, 'game' => $game->id]) }}">Matches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('games.athletes', ['event' => $event->id, 'game' => $game->id]) }}">Athletes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('games.settings', ['event' => $event->id, 'game' => $game->id]) }}">Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <div class="pe-1 py-2">
                        <a href="{{ route('events.show', ['event' => $event->id]) }}" class="custBtn custBtn-light"><i
                                class="bi bi-arrow-left"></i>&nbsp Back to All Games</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>