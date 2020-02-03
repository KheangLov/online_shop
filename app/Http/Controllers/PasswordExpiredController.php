<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordExpiredController extends Controller
{
    protected function validator(array $data)
    {
        return tap(Validator::make($data, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]));
    }

    public function edit($id)
    {
        return view('password-expired', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (Hash::check($request->old_password, $user->password)) {
            $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($user->password_expires_at)));
            $user->password = Hash::make($request->new_password);
            $user->password_expires_at = $effectiveDate;
            $user->save();
            $user->update();
            return redirect()->route('login');
        }
        return view('password-expired', ['id' => $id]);
    }
}
