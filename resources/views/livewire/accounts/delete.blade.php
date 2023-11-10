<div>
    <div class="text-dark p-3">
        <h3 class=" fw-bold">DELETE USER ACCOUNT</h3>
        <hr class="mb-0">
    </div>

    <div class="container">
        <div class="container-fluid text-dark py-3">
            <div class="p-4"
                style="border-style: solid; border-width: 1px; border-color: #A7A7A7; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">

                <div class="d-flex align-items-center">
                    <i class="bi bi-x-circle-fill text-danger fs-1"></i>
                    <span class="fs-4 ms-4">Are you sure to delete this record?</span>
                </div>

                <form wire:submit.prevent="destroy">
                    <div class="form-group d-flex justify-content-end pt-4">
                        <a href="{{ route('accounts') }}" class="custBtn custBtn-light">Cancel</a>
                        <button type="submit" value="true" class="custBtn custBtn-red ms-3">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>