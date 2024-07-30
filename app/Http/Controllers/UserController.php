<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyModel;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index() {
        $allUsers = User::query()->paginate(10);
        return view('user.index', compact('allUsers'));
    }


    public function view( $id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back();
        }
        $companies = CompanyModel::all();
        return view('user.view', compact('user', 'companies'));
    }

    public function store(UserRequest $request, $id) {
        $validatedData = $request->validated();
        dd($validatedData);
    }

    public function delete($id) {
        return 'deleted';
    }
}
