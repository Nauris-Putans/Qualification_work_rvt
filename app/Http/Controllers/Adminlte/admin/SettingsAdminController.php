<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\Country;
use App\Http\Requests\NotificationRequest;
use App\Http\Requests\PasswordSecurityRequest;
use App\Http\Requests\PersonalInfoRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Models\Adminlte\admin\SettingsAdmin;
use App\Http\Controllers\Controller;
use App\User;
use Hashids\Hashids;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * SettingsAdminController
 */
class SettingsAdminController extends Controller
{
    use UploadTrait;

    /**
     * Updates personal info in account settings section
     *
     * @param PersonalInfoRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function personal_info_update(PersonalInfoRequest $request, $id)
    {
        // Hash key for id security
        $hashids = new Hashids(env("HASHIDS"), 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds user by $id
        $user = User::find($id)->first();

        // Finds country name by $request->country
        $countryName = Country::where('name', !empty($request->country) ? $request->country : $request->country_old)->first();

        // Changing date format - from string to date
        $time = strtotime(str_replace('/', '-', $request->birthday));

        // Checks if $time is null
        if ($time == null)
        {
            $birthday = null;
        }

        else
        {
            $birthday = date('Y-m-d', $time);
        }

        // Storing new info in $data
        $data = [
            'name' => ucwords($request->fullname),
            'email' => $request->email_address,
            'phone_number' => $request->phone_without_mask,
            'country' => !empty($countryName->id) ? $countryName->id : null,
            'city' => !empty(ucfirst($request->city)) ? ucfirst($request->city) : null,
            'gender' => !empty(ucfirst($request->gender)) ? ucfirst($request->gender) : $request->gender_old,
            'birthday' => !empty($birthday) ? $birthday : $request->birthday_old,
        ];

        // Updates user with $data values
        $user->update($data);

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Personal Information"), 'action' => __("has been updated!")]));
    }

    /**
     * Updates notification in account settings section
     *
     * @param NotificationRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function notification_update(NotificationRequest $request,$id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        dd("Need to create notification section");

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Notifications"), 'action' => __("has been updated!")]));
    }

    /**
     * Updates password security in account settings section
     *
     * @param PasswordSecurityRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password_security_update(PasswordSecurityRequest $request, $id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds user by $id
        $user = User::find($id)->first();

        // Storing new info in $data
        $data = [
            'password'=> Hash::make($request->new_password),
        ];

        // Updates user with $data values
        $user->update($data);

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Password & Security"), 'action' => __("has been updated!")]));
    }

    /**
     * Updates user profile image in account settings section
     *
     * @param ProfileImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileImageRequest $request)
    {
        // Get current user
        $user = User::findOrFail(auth()->user()->id);

        // Check if a profile image has been uploaded
        if ($request->has('profile_image'))
        {
            // Previous profile image path
            $usersImage = public_path($user->profile_image);

            // Checks if file exists
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
            $folder = '/storage/uploads/profile_images/';

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();

            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }

        // Persist user record to database
        $user->save();

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Profile image"), 'action' => __("has been updated!")]));
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

        // Finds country by $countryID
        $countryName = Country::find($user->country);

        return view('adminlte.admin.account-settings-admin', compact('countries', 'hashids', 'user', 'countryName'));
    }
}
