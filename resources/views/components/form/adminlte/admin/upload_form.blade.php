<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="POST" action="/admin/settings/profile_image/update" enctype="multipart/form-data">
                @csrf

                <div class="col-12 mb-4">
                    <h3 class="card-header text-white mb-3">
                        {{ __('Upload a New Photo') }}
                    </h3>
                </div>

                <div class="col-12 mb-4 form-group">
                    <div class="custom-file">

                        @if (App::isLocale('us'))
                            <input class="custom-file-input"
                                   name="profile_image"
                                   type="file"
                                   id="profile_image"
                                   aria-describedby="profile_image"
                                   lang="us"
                            >
                        @elseif (App::isLocale('lv'))
                            <input class="custom-file-input"
                                   name="profile_image"
                                   type="file"
                                   id="profile_image"
                                   aria-describedby="profile_image"
                                   lang="lv"
                            >
                        @elseif (App::isLocale('ru'))
                            <input class="custom-file-input"
                                   name="profile_image"
                                   type="file"
                                   id="profile_image"
                                   aria-describedby="profile_image"
                                   lang="ru"
                            >
                        @else
                            <input class="custom-file-input"
                                   name="profile_image"
                                   type="file"
                                   id="profile_image"
                                   aria-describedby="profile_image"
                                   lang="us"
                            >
                        @endif

                        <label class="custom-file-label text-left" for="profile_image">
                            {{ __('No file Chosen') }}
                        </label>
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <div class="col-md-12 justify-content-center">
                        <button type="submit" class="btn btn-light">
                            {{ __('Update Profile Photo') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
