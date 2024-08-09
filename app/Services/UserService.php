<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserDelManyRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class UserService {

    protected $userRepository, $companyRepository;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository) {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    public function index() {
        $user = Auth::user();
        $users = $this->userRepository->getAll();

        if ($user->role && $user->company_id) {
            $users = $this->userRepository->search('company_id', $user->company_id);
        }
        return $users;
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

    public function delete(UserDelManyRequest $request) {
        $user = Auth::user();
        $data = $request->ids;
        // kiểm tra user là company account và thuộc 1 công ty
        if ($user->role && $user->company_id) {
            $userIdSameCompany = [];
            $company = $this->companyRepository->getCompanyById($user->company_id);
            foreach($company->load('user')->user as $user) {
                // chọn ra user không phải là company account
                if (!$user->role) {
                    $userIdSameCompany[] = $user->id;
                }
            }
            // chỉ lấy id của user cùng công ty
            $data = array_intersect($data, $userIdSameCompany);
        }

        return $this->userRepository->delete($data);
    }

    public function getCompany() {
        $user = Auth::user();
        if ($user->is_admin) {
            return $this->companyRepository->getAll(false);
        }
        return $user->company;
    }
}
