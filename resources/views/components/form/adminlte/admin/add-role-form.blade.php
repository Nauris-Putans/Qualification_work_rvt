<x-alertAdmin />
<div class="boxed">
    <div class="input-info text-white">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/admin/add-role">
                @csrf

                {{-- Role name input--}}
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <input
                            name="roleName"
                            type="text"
                            class="form-control @error('roleName') is-invalid @enderror"
                            placeholder="{{__('Role name')}}"/>
                    </div>
                </div>

                {{-- Role display name input--}}
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <input
                            name="roleDisplayName"
                            type="text"
                            class="form-control @error('roleDisplayName') is-invalid @enderror"
                            placeholder="{{__('Role display name (optional)')}}"/>
                    </div>
                </div>

                {{-- Role desc input--}}
                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <input
                            name="roleDesc"
                            type="text"
                            class="form-control @error('roleDesc') is-invalid @enderror"
                            placeholder="{{__('Role description (optional)')}}"/>
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
