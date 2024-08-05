<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() {
        return $this->userService->index();
    }

    public function create() {
        return $this->userService->create();
    }

    public function store(UserCreateRequest $request) {
        $this->userService->store($request);
        return redirect()->back();
    }

    public function edit($id) {
        return $this->userService->edit($id);
    }

    public function update(UserRequest $request, $id) {
        $this->userService->update($request, $id);
        return redirect()->back();
    }

    public function delete($id) {
        $this->userService->deleteUser($id);
        return redirect()->back();
    }
}
