<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfusionsoftLog extends Model
{
    //
    protected $table = 'infusionsoft_logs';

    protected $fillable = [
        'infusionsoft_account_id',
        'data'
    ];

    public function infusionsoftAccount()
    {
        return $this->belongsTo(InfusionsoftAccount::class);
    }
}
