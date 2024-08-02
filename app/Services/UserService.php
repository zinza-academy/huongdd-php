<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;

class UserService {

    protected $userRepository, $companyRepository;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository) {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    public function index() {
        if (Auth::user()->is_admin || Auth::user()->role) {
            $allUsers = $this->userRepository->getAll(10, true);
            return view('user.index', compact('allUsers'));
        }
        return redirect()->back();
    }

    public function create() {
        $companies = $this->companyRepository->getAll(50, false);
        return view('user.create', compact('companies'));
    }

    public function store($request) {
        if (!empty($request->avatar)) {
            $data['avatar'] = uploadFile($request->avatar, 'avatars');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_id' => $request->company,
            'points' => 0,
            'dob' => $request->dob,
        ];
        Session::flash('success', 'User created!');
        return $this->userRepository->create($data);
    }

    public function edit($id) {
        $user = $this->userRepository->getUserById($id);
        $companies = $this->companyRepository->getAll(50, false);
        return view('user.view', compact('user', 'companies'));
    }

    public function update($request, $id){
        $user = $this->userRepository->getUserById($id);
        if (!empty($request->avatar)) {
            $user->avatar = uploadFile($request->avatar, 'avatars');
        }
        $user->name = $request->name;
        $user->role = $request->role;
        $user->company_id = $request->company !== '0' ? $request->company : null;
        $user->dob = $request->dob;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        Session::flash('success', 'User updated!');
        return $user->save();
    }

    public function deleteUser($id) {
        $user = $this->userRepository->getUserById($id);
        Session::flash('success', 'User deleted!');
        return $user->delete();
    }
}
