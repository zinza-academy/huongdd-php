<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CompanyModel extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = ['name', 'logo', 'address', 'status', 'max_users'];

    public function members() {
        return $this->hasMany(User::class);
    }
}
