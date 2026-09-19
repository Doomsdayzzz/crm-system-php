<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private const PER_PAGE = 10;
    public function index()
    {
        $users = User::query()->paginate(self::PER_PAGE);

        return view('users.index', [
            'users' => $users
        ]);
    }
}
