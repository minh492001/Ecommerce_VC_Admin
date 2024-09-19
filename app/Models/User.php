<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getAdmin()
    {
        return self::select('users.*', 'company.name as company_name')
            ->join('company', 'company.id', '=', 'users.company_id')
            ->where('users.is_admin', 1)
            ->where('users.is_delete', 0)
            ->orderBy('users.id', 'desc')
            ->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function checkEmail($email)
    {
        return self::select('users.email')
            ->where('email', '=', $email)
            ->first();
    }

    static public function getCustomer($company_id)
    {
        $return = self::select('users.*', 'company.name as company_name')
            ->join('company', 'company.id', '=', 'users.company_id')
            ->where('users.is_admin', 0)
            ->where('users.is_delete', 0);

        if (Auth::user()->is_admin == 1 && Auth::user()->company_id != 1) {
            $return = $return->where('users.company_id', $company_id);

        }
        elseif (Auth::user()->is_admin == 0 && Auth::user()->company_id != 1) {
            $return = $return->where('users.company_id', $company_id)
                ->where('users.status', 0);
        }

        $return = $return->orderBy('users.id', 'desc')
            ->get();

        return $return;
    }

    static public function getRecord()
    {
        return self::select('users.*')
            ->where('users.is_delete', 0)
            ->orderBy('users.id', 'desc')
            ->get();
    }

    static public function getTotalCustomer($company_id)
    {
        $return = self::select('id')
            ->where('is_delete', 0);

        if (Auth::user()->is_admin == 1 && Auth::user()->company_id == 1) {
            $return= $return->where('company_id', '!=', 1)
                ->where('is_admin', 0);
        }
        else {
            $return = $return->where('company_id', $company_id)
                ->where('is_admin', 0)
                ->where('status', 0);
        }

        $return = $return->count();

        return $return;
    }

    static public function getTotalMembers()
    {
        return self::select('id')
            ->where('is_delete', 0)
            ->where('company_id', '!=', 1)
            ->count();
    }

    static public function getNewCustomer()
    {
        return self::select('users.*', 'company.name as company_name')
            ->join('company', 'company.id', '=', 'users.company_id')
            ->where('users.is_delete', 0)
            ->where('users.is_admin', 0)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }

    public function getCompany()
    {
        return $this->belongsTo(CompanyModel::class, 'company_id', 'id');
    }

    public function getOrder()
    {
        return $this->hasMany(Order::class, 'user_id')
            ->count();
    }
}
