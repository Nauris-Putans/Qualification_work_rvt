<x-alert />
<div class="boxed">
    <div class="input-info text-white">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/contacts/create" id="ticket">
                @csrf

                <div class="col-md-12 mt-3">
                    <div class="row">
                        {{-- Title input--}}
                        <div class="col-md-6 form-group">
                            <input
                                name="title"
                                type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="{{ __('Title') }}*"
                                value="{{ old('title') }}"
                            />
                        </div>

                        {{-- Type input--}}
                        <div class="col-md-6 form-group">
                            <select class="form-control @error('type') is-invalid @enderror" name="type" form="ticket">
                                <option hidden disabled selected value>{{ __('Please choose message type') }}*</option>
                                <optgroup label="{{ __('Type') }}">

                                    <option value="question" @if (old('type') == "question") {{ 'selected' }} @endif>
                                        {{ __('Question') }}
                                    </option>

                                    <option value="problem" @if (old('type') == "problem") {{ 'selected' }} @endif>
                                        {{ __('Problem') }}
                                    </option>

                                    <option value="job-vacancie" @if (old('type') == "job-vacancie") {{ 'selected' }} @endif>
                                        {{ __('Job vacancie') }}
                                    </option>

                                    <option value="other" @if (old('type') == "other") {{ 'selected' }} @endif>
                                        {{ __('Other') }}
                                    </option>

                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        {{-- Full Name input--}}
                        <div class="col-md-6 form-group">
                            <input
                                name="fullname"
                                type="text"
                                class="form-control @error('fullname') is-invalid @enderror"
                                placeholder="{{ __('Full Name') }}*"
                                value="{{ old('fullname') }}"
                            />
                        </div>

                        {{-- Email input--}}
                        <div class="col-md-6 form-group">
                            <input
                                name="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('Email') }}*"
                                value="{{ old('email') }}"
                            />
                        </div>
                    </div>
                </div>

                {{-- Message input--}}
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea
                            name="message"
                            class="form-control @error('message') is-invalid @enderror"
                            placeholder="{{ __('Message') }}*"
                        >{{ old('message') }}
                        </textarea>
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

                {{-- Contact us button--}}
                <div class="col-md-12 justify-content-center mt-2 mb-5">
                    <button type="submit" class="btn btn-orange orange-hover">
                        {{ __('Send message') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
