<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyModel;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $allUsers = User::query()->paginate(10);
        return view('user.index', compact('allUsers'));
    }


    public function view( $id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('fail', 'User not found');
        }
        $companies = CompanyModel::all();
        return view('user.view', compact('user', 'companies'));
    }

    public function store(UserRequest $request, $id) {
        $validatedData = $request->validated();
        $user = User::find($id);
        if (!empty($validatedData['old_password'])
        && !empty($validatedData['password'])
        && !empty($validatedData['password_confirm'])) {
            // if ($validatedData['old_password'])
            dd($user->password, Hash::make($validatedData['old_password']));
        }
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('succes', 'User deleted successfully!');
    }
}
