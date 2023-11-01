<div>
    <div class="row g-4 p-3">
        <div class="container text-dark py-3">
            <h3 class=" fw-bold">ADD CATEGORY</h3>
            <hr class="mb-0">
        </div>
    </div>

    <div class="row g-4 p-3">
        <div class="container text-dark py-3">
            <div class="p-4"
                style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
    
                <form wire:submit.prevent="store">
                    <div class="row row-cols-1 row-cols-sm-2 g-4">
                        <div class="form-group col">
                            <label for="class_label">Class Label<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="class_label" id="class_label"
                                class="form-control custInput @error('class_label') is-invalid @enderror" type="text"
                                name="class_label" maxlength="2" autocomplete="off" placeholder="A-Z" required>
                            @error('class_label')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
    
                        <div class="form-group col">
                            <label for="sex">Sex Category<span style="color: #b63e3e;"> *</span></label>
                            <select wire:model="sex" id="sex" name="sex"
                                class="form-select custFormSelect @error('sex') is-invalid @enderror"
                                aria-label=".form-select example" required>
                                <option class="custOption" hidden>Sex</option>
                                <option class="custOption" value="Male">Male</option>
                                <option class="custOption" value="Female">Female</option>
                            </select>
                            @error('sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="row row-cols-1 row-cols-sm-2 g-4 pt-3">
                        <div class="form-group col">
                            <label for="min_weight">Min Weight (kg)<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="min_weight" id="min_weight"
                                class="form-control custInput @error('min_weight') is-invalid @enderror" type="number"
                                step="0.01" name="min_weight" maxlength="50" autocomplete="off" placeholder="Minimum Weight"
                                required>
                            @error('min_weight')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
    
                        <div class="form-group col">
                            <label for="max_weight">Max Weight (kg)<span style="color: #b63e3e;"> *</span></label>
                            <input wire:model="max_weight" id="max_weight"
                                class="form-control custInput @error('max_weight') is-invalid @enderror" type="number"
                                step="0.01" name="max_weight" maxlength="50" autocomplete="off" placeholder="Maximum Weight"
                                required>
                            @error('max_weight')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group d-flex justify-content-end pt-4">
                        <a href="{{ route('categories') }}" class="custBtn custBtn-light">Cancel</a>
                        <button type="submit" value="true" class="custBtn custBtn-green ms-3">Save</button>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
</div>