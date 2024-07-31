<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyModel;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $allUsers = User::withTrashed()->paginate(10);
        return view('user.index', compact('allUsers'));
    }


    public function view(FormRequest $request ,$id) {
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
        // dd($validatedData);
        if (!empty($validatedData['avatar'])) {
            $file = $validatedData['avatar'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $request->file('avatar')->storeAs('avatars', $filename, 'public');
            $user->avatar = 'avatars/' . $filename;
        }
        $user->name = $validatedData['name'];
        $user->role = $validatedData['role'];
        $user->company_id = $validatedData['company'];
        $user->dob = $validatedData['dob'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();
        $toast = [
            'type' => 'success',
            'message' => 'User updated successfully!'
        ];
        return redirect()->back()->with($toast);
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        $toast = [
            'type' => 'success',
            'message' => 'User deleted successfully!'
        ];
        return redirect()->back()->with($toast);
    }
}
