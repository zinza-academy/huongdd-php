<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'companies';

    public function user() {
        return $this->hasMany(User::class, 'company_id');
    }
}
