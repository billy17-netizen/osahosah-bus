<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Exception;
use File;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('frontend.profile.index');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'mobile_number' => 'required',
                'city' => 'required',
                'address' => 'required',
                'state' => 'required',
                'life_insuranse' => 'required',
            ]);

            $user = auth()->user();

            // Update user data
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'mobile_number' => $validatedData['mobile_number'],
                'city' => $validatedData['city'],
                'address' => $validatedData['address'],
                'state' => $validatedData['state'],
                'life_insuranse' => $validatedData['life_insuranse'],
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (ValidationException $e) {
            // Handle validation exception
            return redirect()->back()->with('error', 'There was an error updating the profile: ' . $e->getMessage());
        } catch (Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'There was an error updating the profile: ' . $e->getMessage());
        }
    }

    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'profile-photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $user = auth()->user();
            // Handle profile photo upload
            if ($request->hasFile('profile-photo')) {
                // Delete an old profile photo if it exists
                if ($user->avatar) {
                    File::delete(public_path($user->avatar));
                }

                // Upload a new profile photo
                $profilePhoto = $request->file('profile-photo');
                $name = $user->name . '_' . time() . '.' . $profilePhoto->getClientOriginalExtension();
                $filePath = '/uploads/profile/' . $name;
                $profilePhoto->move(public_path('/uploads/profile'), $name);

                $user->avatar = $filePath;
                $user->save();
            }

            return response()->json(['message' => 'Profile photo updated successfully']);
        } catch (Exception $e) {
            // Handle the exception
            return response()->json(['message' => 'There was an error updating the profile photo: ' . $e->getMessage()]);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = auth()->user();

            if (!Hash::check($request->current_password, $user->getAuthPassword())) {
                return redirect()->back()->with('error', 'The current password is incorrect');
            }

            if ($request->new_password !== $request->confirm_password) {
                return redirect()->back()->with('error', 'The new password and confirm password do not match');
            }

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password changed successfully');
        } catch (Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'There was an error changing the password: ' . $e->getMessage());
        }
    }
}
