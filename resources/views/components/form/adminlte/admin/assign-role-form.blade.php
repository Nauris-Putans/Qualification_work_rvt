<x-alertAdmin />
<div class="boxed">
    <div class="input-info text-dark">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/admin/assign-role">
                @csrf

                {{-- Roles dropbox --}}
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <label>
                            {{__('Roles')}}
                        </label>
                        <select name="role" class="form-control">
                            <option>
                                -
                            </option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
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

                {{-- Assign Role button--}}
                <div class="col-md-8">
                    <input
                        name="assignRole"
                        type="submit"
                        class="btn btn-primary mt-2"
                        value="{{__('Assign role')}}"
                    />
                </div>
            </form>
        </div>
    </div>
</div>
