<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth', 'verified']);
    }

    public function get() {
        $user = User::find(Auth::user()->id);
        return $user->notifications;
    }
}
