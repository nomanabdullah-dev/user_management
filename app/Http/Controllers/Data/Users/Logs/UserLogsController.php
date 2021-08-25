<?php

namespace App\Http\Controllers\Data\Users\Logs;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;

class UserLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('isUser')->only('index');
    }

    public function index(User $user)
    {
        return response()->json(['results' => UserLog::byUser($user->id)->latest()->paginate(50)]);
    }
}
