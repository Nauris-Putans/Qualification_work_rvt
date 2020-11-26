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
            <button type="submit" class="btn btn-info mt-2 text-white">
                <i class="fas fa-pencil-alt mr-1"></i>
                {{ __('Assign Role') }}
            </button>
        </div>
    </div>
</div>
