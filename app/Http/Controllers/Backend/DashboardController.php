<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Routine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('backend.dashboard.admin');
        } else {
            $routines=Routine::with(['batch','classes'=>function ($q){
                return $q->owned();
            },'classes.teacher','classes.subject'])->owned()->orderBy('routine_date','ASC')->get();
            $routines=$routines->groupBy('routine_date');
            return view('backend.dashboard.others',compact('routines'));
        }
    }

    function profile()
    {
        $user = auth()->user();
        return view('backend.user.profile', compact('user'));
    }


    function updateProfile(Request $request)
    {
        $request->validate([
            'previous_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->previous_password, $user->password)) {
            return redirect()->back()->with('error', 'Previous password is incorrect');
        }
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Password updated successfully');
    }

    function editUser($id = null)
    {
        if (!$id) {
            $id = auth()->user()->id;
        }
        if (auth()->user()->hasRole('admin')) {
            $user = User::findOrFail($id);
            return view('backend.user.edit', compact('user'));
        } else {
            $user = User::findOrFail(auth()->user()->id);
            return view('backend.user.edit', compact('user'));
        }
    }

    function updateUser($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'district' => 'required',
            'city' => 'required',
            'street' => 'required',
        ]);

        if (auth()->user()->hasRole('admin')) {
            $user = User::findOrFail($id);
        } else {
            $user = User::findOrFail(auth()->user()->id);
        }
        $address = Address::firstOrCreate([
            'district' => $request->district,
            'city' => $request->city,
            'street' => $request->street,
        ]);

        $user->address_id = $address->id;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        if (auth()->user()->hasRole('admin')) {
            if ($user->hasRole('customer')) return redirect()->route('backend.user.index')->with('success', 'User updated successfully');
            elseif ($user->hasRole('branch')) return redirect()->route('backend.branch.index')->with('success', 'Branch updated successfully');
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('success', 'Profile updated successfully');
        }
    }
}
