<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Psy\Readline\Hoa\Console;

class UserController extends Controller
{
    private const PER_PAGE = 10;

    public function index()
    {
        return view('users.index', [
            'countActiveUsers' => User::query()
                ->select(['users.id'])
                ->whereNotNull('users.email_verified_at')
                ->count(),
            'countDeactivatedUsers' => User::query()
                ->select(['users.id'])
                ->whereNull('users.email_verified_at')
                ->count(),
            'countApplications' => Application::query()
                ->count(),
            'users' => User::query()
                ->with('applications')->paginate(self::PER_PAGE)
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated =  $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);



//        dd($request->all());
    }
}
