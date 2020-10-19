<x-alertAdmin />
<div class="boxed">
    <div class="input-info text-white">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/admin/add-permission">
                @csrf

                {{-- Permission name input--}}
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <input
                            name="permissionName"
                            type="text"
                            class="form-control @error('permissionName') is-invalid @enderror"
                            placeholder="{{__('Permission name')}}"/>
                    </div>
                </div>

                {{-- Permission display name input--}}
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <input
                            name="permissionDisplayName"
                            type="text"
                            class="form-control @error('permissionDisplayName') is-invalid @enderror"
                            placeholder="{{__('Permission display name (optional)')}}"/>
                    </div>
                </div>

                {{-- Role desc input--}}
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <input
                            name="permissionDesc"
                            type="text"
                            class="form-control @error('Permission') is-invalid @enderror"
                            placeholder="{{__('Permission description (optional)')}}"/>
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
