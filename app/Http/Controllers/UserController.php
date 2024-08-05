<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserDelManyRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $userService, $userRepository, $companyRepository;
    public function __construct(UserService $userService, UserRepository $userRepository, CompanyRepository $companyRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    public function index() {
        $allUsers = $this->userService->index();
        return view('user.index', compact('allUsers'));
    }

    public function create() {
        $user = Auth::user();
        $companies = $this->userService->getCompany();
        return view('user.create', compact('companies', 'user'));
    }

    public function store(UserCreateRequest $request) {
        $this->userService->store($request);
        Session::flash('success', 'User created!');
        return redirect()->back();
    }

    public function edit($id) {
        $user = $this->userRepository->getUserById($id);
        if (Gate::allows('update-user', $user)) {
            $companies = $this->userService->getCompany();
            return view('user.view', compact('user', 'companies'));
        }
        Session::flash('error', 'You have no permissions');
        return redirect()->back();
    }

    public function update(UserRequest $request, $id) {
        $this->userService->update($request, $id);
        Session::flash('success', 'User updated!');
        return redirect()->back();
    }

    public function delete($id) {
        $user = $this->userRepository->getUserById($id);
        if (Gate::allows('delete-user', $user)) {
            $this->userService->deleteUser($id);
            Session::flash('success', 'User deleted!');
            return redirect()->back();
        }
        Session::flash('error', 'You have no permissions');
        return redirect()->back();
    }

    public function deleteMany(UserDelManyRequest $request) {
        $this->userService->delete($request);
        Session::flash('success', 'Users deleted!');
        return redirect()->back();
    }
}
