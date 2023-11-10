<div>
    <div class="text-dark p-3">
        <h3 class=" fw-bold">ADD GAME</h3>
        <hr class="mb-0">
    </div>

    <div class="container">
        <div class="container-fluid text-dark py-3">
            <div class="p-4"
                style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">

                <form wire:submit.prevent="store">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <div class="form-group col">
                            <label for="name">Game Name<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="name" id="name"
                                class="form-control custInput @error('name') is-invalid @enderror" type="text"
                                name="name" autocomplete="off" placeholder="Game Name" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="sex">Sex Category<span style="color: #b63e3e;"> *</span></label>
                            <select wire:model.live="sex" id="sex" name="sex"
                                class="form-select custFormSelect @error('sex') is-invalid @enderror"
                                aria-label=".form-select example" required>
                                <option class="custOption" hidden>Sex Category</option>
                                <option class="custOption" value="Male">Male</option>
                                <option class="custOption" value="Female">Female</option>
                            </select>
                            @error('sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="category_id">Class Label<span style="color: #b63e3e;"> *</span></label>
                            <select wire:model.live="category_id" id="category_id" name="category_id"
                                class="form-select custFormSelect @error('category_id') is-invalid @enderror"
                                aria-label=".form-select example" required>
                                <option class="custOption" hidden>Class Label</option>
                                @if ($categories)
                                @foreach ($categories as $category)
                                <option class="custOption" value="{{ $category->id }}">{{
                                    $category->class_label }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-lg-2 g-4 pt-3">
                        <div class="form-group col">
                            <label for="min_weight">Minimum Weight (kg)<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="min_weight" id="min_weight" class="form-control custInput" type="text"
                                name="min_weight" autocomplete="off" placeholder="Minimum Weight" disabled>
                        </div>

                        <div class="form-group col">
                            <label for="max_weight">Maximum Weight (kg)<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="max_weight" id="max_weight" class="form-control custInput" type="text"
                                name="max_weight" autocomplete="off" placeholder="Maximum Weight" disabled>
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-end pt-4">
                        <a href="{{ route('events.show', ['event' => $event->id]) }}"
                            class="custBtn custBtn-light">Cancel</a>
                        <button type="submit" value="true" class="custBtn custBtn-green ms-3">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>