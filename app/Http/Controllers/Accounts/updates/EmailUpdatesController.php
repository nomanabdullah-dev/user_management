<?php

namespace App\Http\Controllers\Accounts\updates;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserEmailRequest;

class EmailUpdatesController extends Controller
{
    public function update(UpdateUserEmailRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json(['user'=> $user->only('id','name','email','role')]);
    }
}
