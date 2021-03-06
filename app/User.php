<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_code', 'name', 'email', 'phone', 'work_place', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'is_admin', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *  Login username for oauth server.
     *
     * @return app\User
     */
    public function findForPassport(string $username)
    {
        return $this->orWhere('email', $username)
            ->orWhere('staff_code', $username)
            ->orWhere('phone', $username)
            ->whereNotNull('email_verified_at')
            ->whereNull('deleted_at')
            ->first();
    }

    /**
     * 获取用户头像地址
     *
     * @return string
     */
    public function avatar()
    {
        return $this->avatar;
    }

    /**
     * 设置头像地址
     *
     * @return bool
     */
    public function setAvatar(string $avatarUrl)
    {
        $this->avatar = $avatarUrl;

        return $this->save();
    }
}
