<x-alertAdmin />
<div class="boxed">
    <div class="input-info text-white">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/admin/add-permission">
                @csrf

                {{-- Permission name input--}}
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <label for="name" class="text-dark">
                            {{__('Permission name *')}}
                        </label>
                        <input
                            name="permissionName"
                            type="text"
                            class="form-control @error('permissionName') is-invalid @enderror">
                    </div>
                </div>

                {{-- Permission display name input--}}
                <div class="col-md-4 mt-3">
                    <div class="form-group">
                        <label for="name" class="text-dark">
                            {{__('Permission display name (optional)')}}
                        </label>
                        <input
                            name="permissionDisplayName"
                            type="text"
                            class="form-control @error('permissionDisplayName') is-invalid @enderror">
                    </div>
                </div>

                {{-- Role desc input--}}
                <div class="col-md-4 mt-3">
                    <div class="form-group">
                        <label for="name" class="text-dark">
                            {{__('Permission description (optional)')}}
                        </label>
                        <input
                            name="permissionDesc"
                            type="text"
                            class="form-control @error('Permission') is-invalid @enderror">
                    </div>
                </div>

                {{-- Add Permission button--}}
                <div class="col-md-8">
                    <input
                        name="addPermission"
                        type="submit"
                        class="btn btn-primary mt-2"
                        value="{{__('Add permission')}}"
                    />
                </div>
            </form>
        </div>
    </div>
</div>
