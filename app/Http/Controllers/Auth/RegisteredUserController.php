<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $validate = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
            'ttd' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        // Rename file sesuai nama user
        $file = $request->file('ttd');
        $ext = $file->getClientOriginalExtension();
        $filename = 'ttd_' . str_replace(' ', '_', strtolower($request->name)) . '.' . $ext;

        // Simpan file ke storage/app/public/ttd
        $filePath = $file->storeAs('ttd', $filename, 'public');

        // Simpan user
        $validate['password'] = bcrypt($request->password);
        $validate['ttd'] = $filePath;
        // dd($validate);
        $user = User::create($validate);

        event(new Registered($user));

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}
