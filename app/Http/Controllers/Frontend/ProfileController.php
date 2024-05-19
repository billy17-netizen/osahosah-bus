<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Exception;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
                'profile-photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $user = auth()->user();

            // Handle profile photo upload
            if ($request->hasFile('profile-photo')) {
                // Delete old profile photo if it exists
                if ($user->avatar) {
                    File::delete(public_path($user->avatar));
                }

                // Upload new profile photo
                $profilePhoto = $request->file('profile-photo');
                $name = $user->name . '_' . time() . '.' . $profilePhoto->getClientOriginalExtension();
                $filePath = '/uploads/profile/' . $name;
                $profilePhoto->move(public_path('/uploads/profile'), $name);

                $user->avatar = $filePath;
            }

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
        } catch (FileNotFoundException $e) {
            // Handle file not found exception
            return redirect()->back()->with('error', 'There was an error updating the profile: ' . $e->getMessage());
        } catch (Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'There was an error updating the profile: ' . $e->getMessage());
        }
    }
}
