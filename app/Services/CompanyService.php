<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Session;

class CompanyService {
    protected $companyRepository;

    public function __construct(CompanyRepository $repository)
    {
        $this->companyRepository = $repository;
    }

    public function index() {
        $companies = $this->companyRepository->getAll();
        return view('company.index', compact('companies'));
    }

    public function edit($id) {
        $company = $this->companyRepository->getCompanyById($id);
        return view('company.edit', compact('company'));
    }

    public function update($request, $id) {
        $company = $this->companyRepository->getCompanyById($id);
        if (!empty($request->logo)) {
            $company->logo = uploadFile($request->logo, 'logos');
        }
        $company->name = $request->name;
        $company->status = $request->status;
        $company->max_users = $request->max_users;
        $company->address = $request->address;
        Session::flash('success', 'Company updated!');
        return $company->save();
    }
}
