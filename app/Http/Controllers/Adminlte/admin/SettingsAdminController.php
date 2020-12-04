<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\Country;
use App\Http\Requests\PersonalInfoRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Models\Adminlte\admin\SettingsAdmin;
use App\Http\Controllers\Controller;
use App\User;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class SettingsAdminController extends Controller
{
    use UploadTrait;

    /**
     * @param PersonalInfoRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function personal_info_update(PersonalInfoRequest $request, $id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds user by $id
        $user = User::find($id)->first();

        // Changing date format - from string to date
        $time = strtotime($request->birthday);
        $birthday = date('Y-m-d',$time);

        // Storing new info in $data
        $data = [
            'name' => ucwords($request->fullname),
            'email' => $request->email_address,
            'phone_number' => $request->phone_without_mask,
            'country' => $request->country,
            'city' => ucfirst($request->city),
            'gender' => ucfirst($request->gender),
            'birthday' => $birthday,
        ];

        // Updates user with $data values
        $user->update($data);

        return redirect()->back()->with('message', __('Personal info has been updated!'));
    }

    public function updateProfile(ProfileImageRequest $request)
    {
        // Get current user
        $user = User::findOrFail(auth()->user()->id);

        // Check if a profile image has been uploaded
        if ($request->has('profile_image'))
        {
            // Previous profile image path
            $usersImage = public_path($user->profile_image);

            if (File::exists($usersImage))
            {
                // Deletes previous profile image
                File::delete($usersImage);
            }

            // Get image file
            $image = $request->file('profile_image');

            // Make a image name based on user name and current timestamp
            $name = Str::slug($user->name).'_'.time();

            // Define folder path
            $folder = '/uploads/profile_images/';

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();

            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }

        // Persist user record to database
        $user->save();

        return redirect()->back()->with('image_message', __('Profile image was updated!'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function show()
    {
        // Finds all countries and stores in $countries
        $countries = Country::all();

        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Finds users id by Auth model
        $id = Auth::id();

        // Finds user by $id
        $user = User::find($id);

        return view('adminlte.admin.account-settings-admin', compact('countries', 'hashids', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function edit(SettingsAdmin $settingsAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function update(Request $request, SettingsAdmin $settingsAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function destroy(SettingsAdmin $settingsAdmin)
    {
        //
    }
}
