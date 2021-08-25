<?php

namespace App\Http\Controllers\Accounts\updates;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserNameRequest;
use App\Models\User;
use Illuminate\Http\Request;

class NameUpdatesController extends Controller
{
    public function update(UpdateUserNameRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json(['user'=> $user->only('id','name','email','role')]);
    }
}
