<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InfusionsoftAccount extends Model
{
    //
    protected $table = 'infusionsoft_accounts';

    protected $fillable = [
        'app_name',
        'access_token',
        'refresh_token',
        'expires_in',
        'created_by',
        'auth_key',
        'client_id',
        'client_secret',
        'redirect_url',
        'scope',
        'environment'
    ];


    /**
     * @param null $app
     * @return mixed
     */
    public static function retrieveCurrentInfsAccount($app = null)
    {
        if(!$app) {
            return self::where('environment', config('constants.APP_ENV'))
                ->where('app_name',strtolower($app))
                ->first();
        }

        return self::where('environment', config('constants.APP_ENV'))->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(InfusionsoftLog::class, 'infusionsoft_account_id');
    }

    /**
     * @return \stdClass
     */
    public function getAccessToken()
    {
        $token = new \stdClass();
        $token->access_token = $this->access_token;
        $token->refresh_token = $this->refresh_token;
        $token->expires_in = Carbon::parse($this->expires_in)->timestamp;
        $token->app_name = $this->app_name;

        return $token;
    }

    /**
     * @param $token
     * @return \stdClass
     */
    public function setAccessToken($token)
    {
        $this->access_token = $token['access_token'];
        $this->refresh_token = $token['refresh_token'];
        $this->expires_in = Carbon::parse($token['expires_in'])->toDateTimeString();
        $this->scope = $token['scope'];
        $this->save();

        return $this->getAccessToken();
    }

}
