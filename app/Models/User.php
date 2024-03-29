<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Barangay\Entities\Barangay;
use Modules\UserManagement\Entities\Traits\ApprovalTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, ApprovalTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'barangay_id',
        'password',
        'type',
        'approved_at',
        'phone',
    ];

    const DEFAULT_TYPE = 'Agriculturist';
    const TYPE_ADMIN = 'Administrator';

    public function is($role = 'Administrator'): bool
    {
        return $this->type === \App\Models\User::TYPE_ADMIN;
    }

    public function getNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function barangay () {
        return $this->belongsTo(Barangay::class);
    }

    public function getCountOf($model) {
        if ($this->type == self::TYPE_ADMIN) {
            return $model::count();
        }

        return $model::whereBarangay($this->barangay->name)->count();
    }

    public function title () {
        return $this->name;
    }
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
