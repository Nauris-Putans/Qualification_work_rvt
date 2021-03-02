<div spellcheck="false" class="form justify-content-center">
    <div class="form-group">
        <label for="title" class="col-md-4 control-label">
            {{ __('Title') }}*
        </label>
        <div class="col-12">
            <input id="title"
                   type="text"
                   class="form-control @error('title') is-invalid @enderror"
                   name="title"
                   value="{{ old('title') }}"
            >
        </div>
    </div>

    {{-- Category input--}}
    <div class="form-group">
        <label for="category" class="col-md-4 control-label">
            {{ __('Category') }}*
        </label>
        <div class="col-12">
            <select name="category" id="category" type="category" class="form-control @error('category') is-invalid @enderror">
                <option hidden disabled selected value>
                    {{ __('Select :attribute', ['attribute' => __("Category")]) }}
                </option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ __($category->name) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="message" class="col-md-4 control-label">
            {{ __('Message') }}*
        </label>
        <div class="col-12">
            <textarea rows="10"
                      id="message"
                      class="form-control @error('message') is-invalid @enderror"
                      name="message"
            >{{ old('message') }}</textarea>
        </div>
    </div>

    {{-- Hidden action input--}}
    <div style="display: none">
        <input name="action" value="new_ticket"/>
    </div>

    {{-- Hidden status input--}}
    <div style="display: none">
        <input name="status" value="opened"/>
    </div>

    <div class="form-group">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i>
                {{ __('Create New Ticket') }}
            </button>
        </div>
    </div>
</div>
