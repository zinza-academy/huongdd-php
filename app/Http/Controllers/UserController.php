<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
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
        $allUsers = $this->userRepository->getAll();
        return view('user.index', compact('allUsers'));
    }

    public function create() {
        $companies = $this->companyRepository->getAll(false);
        return view('user.create', compact('companies'));
    }

    public function store(UserCreateRequest $request) {
        $this->userService->store($request);
        Session::flash('success', 'User created!');
        return redirect()->back();
    }

    public function edit($id) {
        $user = $this->userRepository->getUserById($id);
        $companies = $this->companyRepository->getAll(false);
        return view('user.view', compact('user', 'companies'));
    }

    public function update(UserRequest $request, $id) {
        $this->userService->update($request, $id);
        Session::flash('success', 'User updated!');
        return redirect()->back();
    }

    public function delete($id) {
        $this->userService->deleteUser($id);
        Session::flash('success', 'User deleted!');
        return redirect()->back();
    }
}
