<?php

namespace App\Repositories;

use App\User as UserModel;

class AvatarRepository
{
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function avatar($id)
    {
        return $this->user->find($id)->avatar();
    }
}
