<x-alertAdmin />
<div class="boxed">
    <div class="input-info text-dark">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/admin/assign-permission">
                @csrf

                {{-- Permission dropbox --}}
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <label>
                            {{__('Permissions')}}
                        </label>
                        <select name="permission" class="form-control">
                            <option>
                                -
                            </option>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">
                                    {{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Users dropbox --}}
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <label>
                            {{__('Users')}}
                        </label>
                        <select name="user" class="form-control">
                            <option>
                                -
                            </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Assign Permission button--}}
                <div class="col-md-8">
                    <input
                        name="assignPermission"
                        type="submit"
                        class="btn btn-primary mt-2"
                        value="{{__('Assign permission')}}"
                    />
                </div>
            </form>
        </div>
    </div>
</div>
