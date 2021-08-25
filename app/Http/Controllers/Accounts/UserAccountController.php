<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function index(User $user = null)
    {
        if($user === null) {
            return response()->json(['user' => Auth::user()]);
        }
    }
}
