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

    <div class="form-group">
        <label for="category" class="col-md-4 control-label">
            {{ __('Category') }}*
        </label>
        <div class="col-12">
            <select id="category" type="category" class="form-control @error('category') is-invalid @enderror" name="category">
                <option value="">
                    {{ __('Select Category') }}
                </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="priority" class="col-md-4 control-label">
            {{ __('Priority') }}*
        </label>
        <div class="col-12">
            <select id="priority" type="priority" class="form-control @error('priority') is-invalid @enderror" name="priority">
                <option value="">
                    {{ __('Select Priority') }}
                </option>
                <option value="low">
                    {{ __('Low') }}
                </option>
                <option value="medium">
                    {{ __('Medium') }}
                </option>
                <option value="high">
                    {{ __('High') }}
                </option>
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
            ></textarea>
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
