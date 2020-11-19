<div class="input-info text-dark">
    <div spellcheck="false" class="form justify-content-center">
        {{-- Members dropbox --}}
        <div class="col-md-12">
            <div class="form-group">
                <label>
                    {{__('Member')}}
                </label>
                <select name="member" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Assign Role button--}}
        <div class="col-md-12">
            <input
                name="assignRole"
                type="submit"
                class="btn btn-warning mt-2"
                value="{{__('Assign Role')}}"
            />
        </div>
    </div>
</div>
