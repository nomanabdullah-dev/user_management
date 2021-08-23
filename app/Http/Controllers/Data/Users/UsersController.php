<?php

namespace App\Http\Controllers\Data\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(['results' => User::latest()->paginate(20)]);
    }

    public function store(StoreUserRequest $request)
    {
    return $request->all();
    }
}
