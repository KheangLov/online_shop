<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.user.index', ['users' => $users]);
    }

    public function detail($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.detail', ['user' => $user, 'roles' => $roles]);
    }

    protected function validator(array $data)
    {
        return tap(Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required'],
            'profile' => ['file', 'image', 'max:30720']
        ]));
    }

    public function add()
    {
        $roles = Role::all();
        return view('admin.user.add', ['roles' => $roles]);
    }

    public function create(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => (int)$request->phone,
            'status' => $request->status,
            'role_id' => (int)$request->role
        ];

        if (isset($request->profile)) {
            $imageName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images'), $imageName);
            $img = 'images/' . $imageName;
            $data['profile'] = $img;
        }
        $user = User::create($data);
        return redirect()->route('user_list')->with('message', 'User created!');
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
        $roles = Role::all()->sortBy("name");
		$user->name = $request->name;
		$user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
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
        $user = User::find($id);
        $roles = Role::all()->sortBy("name");
        if ($request->password !== $request->password_confirmation) {
            return redirect()
                ->route('user_edit', ['id' => $id, 'user' => $user, 'roles' => $roles])
                ->with('error', 'Wrong password confirmation!');
        }
        $user->password = Hash::make($request->password);
		$user->save();
		$user->update();
		return redirect()
			->route('user_edit', ['id' => $id, 'user' => $user, 'roles' => $roles])
			->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {
        $user = User::find($id);
		$user->delete();
		return redirect()
			->route('user_list')
			->with('success', 'User deleted successfully');
    }
}
