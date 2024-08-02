<?php

namespace App\Repositories;

use App\Models\CompanyModel;

class CompanyRepository {
    public function getAll($paginate, $trashed = true) {
        return $trashed ? CompanyModel::withTrashed()->paginate($paginate) : CompanyModel::paginate($paginate);
    }

    public function getCompanyById($id) {
        return CompanyModel::findOrFail($id);
    }

    public function create($data = []) {
        return $data ? CompanyModel::create($data) : false;
    }
}
