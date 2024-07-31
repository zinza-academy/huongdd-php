<?php

namespace App\Repositories;

use App\Models\CompanyModel;

class CompanyRepository {

    public function getAll($paginate = 10, $trashed = false) {
        return $trashed ? CompanyModel::withTrashed()->paginate($paginate) : CompanyModel::paginate($paginate);
    }

    public function getCompanyById($id) {
        return CompanyModel::findOrFail($id);
    }
}
