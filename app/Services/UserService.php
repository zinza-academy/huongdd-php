<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;

class UserService {

    protected $userRepository, $companyRepository;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository) {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    public function store(UserCreateRequest $request) {
        $data = $request->validated();
        if (!empty($request->avatar)) {
            $data['avatar'] = uploadFile($request->avatar, 'avatars');
        }
        $data['password'] = Hash::make($request->password);
        $data['points'] = 0;
        return $this->userRepository->create($data);
    }

    public function update(UserRequest $request, $id){
        $user = $this->userRepository->getUserById($id);
        $data = $request->validated();
        if (!empty($request->avatar)) {
            $data['avatar'] = uploadFile($request->avatar, 'avatars');
        }
        $data['company_id'] = $request->company !== '0' ? $request->company : null;
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        return $user->update($data);
    }

    public function deleteUser($id) {
        $user = $this->userRepository->getUserById($id);
        return $user->delete();
    }
}
