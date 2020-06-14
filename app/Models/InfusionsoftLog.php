<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfusionsoftLog extends Model
{
    //
    protected $table = 'infusionsoft_logs';

    protected $fillable = [
        'app_name',
        'auth_key',
        'data',
        'infusionsoft_results'
    ];

    public function infusionsoftAccount()
    {
        return $this->belongsTo(InfusionsoftAccount::class);
    }
}
