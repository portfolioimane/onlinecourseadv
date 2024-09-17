<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('frontend.profile.show', compact('user')); // Create view in resources/views/frontend/profile/show.blade.php
    }

    public function edit()
    {
        $user = Auth::user();
        return view('frontend.profile.edit', compact('user')); // Create view in resources/views/frontend/profile/edit.blade.php
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()->route('frontend.profile.show')->with('success', 'Profile updated successfully.');
    }
}
