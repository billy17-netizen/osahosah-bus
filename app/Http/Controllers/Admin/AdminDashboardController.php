<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Customer;
use Exception;
use File;
use Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        //get total earnings from colum total_amount for every booking
        $totalEarnings = Booking::where('status', 'approved')->sum('total_amount');
        //get total booking
        $totalBooking = Booking::count();
        //get total customers
        $totalCustomers = Customer::count();
        //get total bus
        $totalBus = Bus::count();

        // Fetch the booking data for each month
        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->sortKeys()
            ->values();

        // Fetch the month names
        $monthlyBookingMonths = Booking::selectRaw('MONTHNAME(created_at) as month')
            ->groupBy('month')
            ->pluck('month')
            ->sort()
            ->values();

        //Fetch the total_amount for each month
        $monthlyEarnings = Booking::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_amount')
            ->groupBy('month')
            ->pluck('total_amount', 'month')
            ->sortKeys()
            ->values();

        $approvedBookings = Booking::with('user')->where('status', 'approved')->get();
        $pendingBookings = Booking::with('user')->where('status', 'pending')->get();

        return view('admin.dashboard.index', compact('totalEarnings', 'totalBooking', 'totalCustomers', 'totalBus', 'monthlyBookings', 'monthlyBookingMonths', 'monthlyEarnings', 'approvedBookings', 'pendingBookings'));
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request)
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
}
