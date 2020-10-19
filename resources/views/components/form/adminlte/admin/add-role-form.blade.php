<x-alertAdmin />
<div class="boxed">
    <div class="input-info text-white">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/admin/add-role">
                @csrf

                {{-- Role name input--}}
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <label for="name" class="text-dark">
                            {{__('Role name *')}}
                        </label>
                        <input
                            name="roleName"
                            type="text"
                            class="form-control @error('roleName') is-invalid @enderror">
                    </div>
                </div>

                {{-- Role display name input--}}
                <div class="col-md-4 mt-3">
                    <div class="form-group">
                        <label for="name" class="text-dark">
                            {{__('Role display name (optional)')}}
                        </label>
                        <input
                            name="roleDisplayName"
                            type="text"
                            class="form-control @error('roleDisplayName') is-invalid @enderror">
                    </div>
                </div>

                {{-- Role desc input--}}
                <div class="col-md-4 mt-3">
                    <div class="form-group">
                        <label for="name" class="text-dark">
                            {{__('Role description (optional)')}}
                        </label>
                        <input
                            name="roleDesc"
                            type="text"
                            class="form-control @error('roleDesc') is-invalid @enderror">
                    </div>
                </div>

                {{-- Add Role button--}}
                <div class="col-md-8">
                    <input
                        name="addRole"
                        type="submit"
                        class="btn btn-primary mt-2"
                        value="{{__('Add role')}}"
                    />
                </div>
            </form>
        </div>
    </div>
</div>
