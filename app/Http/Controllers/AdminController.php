<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        if (strtolower(Auth::user()->role->name) === 'admin') {
            $activityLogs = Activity::all();
            $lastLog = User::all()->where('last_login_at', '!=', null)->sortByDesc('last_login_at');
            return view('admin.dashboard', ['lastLog' => $lastLog, 'activityLogs' => $activityLogs]);
        }
        return view('admin.dashboard');
    }
}
