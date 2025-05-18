<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->where('id', '!=', auth()->id())
            ->orderBy('name')
            ->get();

        return view('user.index', compact('users'));
    }
    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'active' ? 'non-active' : 'active';
        $user->save();

        return redirect()->route('user.index')->with('success', 'Status pengguna berhasil diperbarui.');
    }
}
