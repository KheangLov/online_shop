<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    public function detail($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.detail', ['user' => $user, 'roles' => $roles]);
    }

    public function add()
    {
        $roles = Role::all();
        return view('admin.user.add', ['roles' => $roles]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required'],
            'password_type' => ['required'],
            'profile' => ['max:5000']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user_add')
                ->withErrors($validator);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => (int)$request->phone,
            'role_id' => (int)$request->role,
            'password_type' => (int)$request->password_type
        ];

        if ((int)$request->password_type === 0) {
            $expire_date = $request->password_expires_at;
            if (empty($request->password_expires_at)) {
                $expire_date = date("Y-m-d");
            }
            $data['password_expires_at'] = $expire_date;
        }

        if (isset($request->profile)) {
            $imageName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images'), $imageName);
            $img = 'images/' . $imageName;
            $data['profile'] = $img;
        }

        $user = User::create($data);
        return redirect()->route('user_list')->with('success', 'User created!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'profile' => ['max:5000']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user_edit', ['id' => $id])
                ->withErrors($validator);
        }

        $roles = Role::all()->sortBy("name");
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password_type = (int)$request->password_type;

        if ((int)$request->password_type === 0) {
            $expire_date = $request->password_expires_at;
            if (empty($request->password_expires_at)) {
                $expire_date = date("Y-m-d");
            }
            $user->password_expires_at = $expire_date;
        } else {
            $user->password_expires_at = null;
        }

        if (isset($request->profile)) {
            $imageName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images'), $imageName);
            $img = 'images/' . $imageName;
            $user->profile = $img;
        }
		$user->role_id = $request->role;
		$user->save();
		$user->update();
		return redirect()
			->route('user_edit', ['id' => $id, 'user' => $user, 'roles' => $roles])
			->with('success', 'User updated successfully!');
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user_edit', ['id' => $id])
                ->withErrors($validator);
        }

        $user = User::find($id);
        $roles = Role::all()->sortBy("name");

        $user->password = Hash::make($request->password);
		$user->save();
		$user->update();
		return redirect()
			->route('user_edit', ['id' => $id, 'user' => $user, 'roles' => $roles])
			->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)
            ->where('id', '!=', Auth::user()->id);

        $deleted = $user->delete();
        if ($deleted === 0)
            return redirect()
                ->route('user_list')
                ->with('warning', 'Can delete current user!');

		return redirect()
			->route('user_list')
			->with('success', 'User deleted successfully');
    }

    public function search(Request $request)
    {
        $users = User::with('role')
            ->whereRaw('LOWER(`name`) LIKE ? ', ['%' . strtolower($request->search) .'%'])
            ->paginate(10);
        // return response()->json(['user' => $user]);
        return view('admin.ajax-search', ['users' => $users]);
    }
}
