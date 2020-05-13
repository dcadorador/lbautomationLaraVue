<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        if( array_key_exists('password', $data) ) {
            $data['password'] = Hash::make( $data['password'] );
        }

        return parent::store($data);
    }
}
