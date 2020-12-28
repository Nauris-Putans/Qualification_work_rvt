<div class="input-info text-dark">
    <div spellcheck="false" class="form justify-content-center">
        {{-- Role name input--}}
        <div class="col-md-12">
            <div class="form-group">
                <label>
                    {{ __('Role name *') }}
                </label>
                <input
                    name="roleName"
                    type="text"
                    class="form-control @error('roleName') is-invalid @enderror">
            </div>
        </div>

        {{-- Role display name input--}}
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label>
                    {{ __('Role display name (optional)') }}
                </label>
                <input
                    name="roleDisplayName"
                    type="text"
                    class="form-control @error('roleDisplayName') is-invalid @enderror">
            </div>
        </div>

        {{-- Role desc input--}}
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label>
                    {{ __('Role description (optional)') }}
                </label>
                <input
                    name="roleDesc"
                    type="text"
                    class="form-control @error('roleDesc') is-invalid @enderror">
            </div>
        </div>

        {{-- Add Role button--}}
        <div class="col-md-12">
            <button type="submit" class="btn btn-success mt-2 text-white">
                <i class="fas fa-plus mr-1"></i>
                {{ __('Add Role') }}
            </button>
        </div>
    </div>
</div>
