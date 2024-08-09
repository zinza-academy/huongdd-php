<?php

namespace App\Repositories;

use App\Models\CompanyModel;
use Illuminate\Support\Facades\Config;

class CompanyRepository {
    protected $companyModel;

    public function __construct(CompanyModel $model) {
        $this->companyModel = $model;
    }

    public function getAll($paginate = true) {
        $companies = $this->companyModel::all();
        if ($paginate) {
            $companies = $this->companyModel::paginate(Config::get('constant.PER_PAGE'));
        }
        return $companies;
    }

    public function getCompanyById($id) {
        return CompanyModel::findOrFail($id);
    }

    public function create($data) {
        return CompanyModel::create($data);
    }
}
