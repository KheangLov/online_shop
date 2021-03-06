<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordExpiredController extends Controller
{
    public function edit($id)
    {
        return view('password-expired', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('password_expired', ['id' => $id])
                ->withErrors($validator);
        }

        $currentDate = Carbon::now();
        $user = User::find($id);
        if (Hash::check($request->old_password, $user->password)) {
            $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($currentDate)));
            $user->password = Hash::make($request->password);
            $user->password_expires_at = $effectiveDate;
            $user->save();
            $user->update();
            return redirect()->route('login');
        }
        return redirect()->route('password_expired', ['id' => $id]);
    }
}
