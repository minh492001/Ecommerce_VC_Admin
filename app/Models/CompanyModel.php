<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use HasFactory;

    protected $table = 'company';

    static public function getRecord()
    {
        return self::select('company.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'company.created_by')
            ->where('company.is_delete', '=', 0)
            ->orderBy('company.id', 'desc')
            ->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function getUser()
    {
        return $this->hasMany(User::class, 'company_id')
            ->where('user.is_delete', 0)
            ->count();
    }
}
