<?php

namespace App\Services;

use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Session;

class CompanyService {
    protected $companyRepository;

    public function __construct(CompanyRepository $repository)
    {
        $this->companyRepository = $repository;
    }

    public function update(CompanyRequest $request, $id) {
        $company = $this->companyRepository->getCompanyById($id);
        $data = $request->validated();
        if (!empty($request->logo)) {
            $data['logo'] = uploadFile($request->logo, 'logos');
        }
        dd($data);
        return $company->update($data);
    }

    public function create(CompanyRequest $request) {
        $data = $request->validated();
        if (isset($request->logo)) {
            $data['logo'] = uploadFile($request->logo, 'logos');
        }
        return $this->companyRepository->create($data);
    }

    public function delete($id) {
        $company = $this->companyRepository->getCompanyById($id);
        return $company->delete();
    }
}
