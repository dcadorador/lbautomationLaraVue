<?php

namespace App\Repositories\Eloquent;

use App\Models\InfusionsoftAccount;
use App\Repositories\Interfaces\InfusionsoftInterface;
use Carbon\Carbon;

class InfusionsoftRepository extends BaseRepository implements InfusionsoftInterface
{
    public function __construct()
    {
        $this->model = new InfusionsoftAccount();
    }

}
