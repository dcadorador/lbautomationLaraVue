<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Infusionsoft\Infusionsoft;
use Infusionsoft\Token as InfusionsoftToken;
use App\Models\InfusionsoftAccount;

class InfusionsoftOauthService
{
    protected $infusionsoftService;
    protected $userService;
    protected $infusionsoftAccount;

    public function __construct(Infusionsoft $infusionsoft, $app = null)
    {
        $this->infusionsoftService = $infusionsoft;
        $this->infusionsoftAccount = is_null($app) ? InfusionsoftAccount::retrieveCurrentInfsAccount() : InfusionsoftAccount::retrieveCurrentInfsAccount($app) ;
    }

    public function getAuthorizationUrl(){
        return $this->infusionsoftService->getAuthorizationUrl();
    }

    public function requestAccessToken($code)
    {
        try {
            $response = $this->infusionsoftService->requestAccessToken($code);
        } catch (\Exception $e) {
            throw (new Exception($e->getMessage()));
        }

        if (!$response) {
            throw (new Exception('Infusionsoft access token request returned null'));
        }

        return $response;
    }

    public function requestAndStoreAccessTokens(Request $request, $clientId = false, $clientSecret = false)
    {
        $accessToken = $this->requestAccessToken($request->code);
        $accesstokenData = $this->transformAttributesOfAuthResponse($accessToken);

        $this->infusionsoftAccount->update($accesstokenData);
    }

    public function transformAttributesOfAuthResponse($tokenData)
    {
        $expire_date = Carbon::createFromTimestamp($tokenData->endOfLife);
        return [
            'access_token' => $tokenData->accessToken,
            'refresh_token' => $tokenData->refreshToken,
            'scope' => $tokenData->extraInfo['scope'],
            'expires_in' => $expire_date,
        ];
    }

    public function checkIfRefreshTokenHasExpired($id = false, $accountId = false)
    {
        $this->setToken($this->infusionsoftAccount->getAccessToken());
        if (!$this->performTestConsumption()) {
            try {
                $refreshToken = $this->infusionsoftService->refreshAccessToken();
            }catch (\Exception $exception){
                die('Infusionsoft account requires reauth.');
            }
            $refreshToken = $this->transformAttributesOfAuthResponse($refreshToken);
            $accessToken = $this->infusionsoftAccount->setAccessToken($refreshToken);
            $this->setToken($accessToken);
        }
        return false;
    }

    public function setToken($accessToken) {

        $token = $this->makeInfusionTokenFromAccessToken($accessToken);
        $this->infusionsoftService->setToken($token);
    }

    public function makeInfusionTokenFromAccessToken($accessToken) {
        return new InfusionsoftToken( [
            'access_token' => $accessToken->access_token,
            'refresh_token' => $accessToken->refresh_token,
            'expires_in' =>  Carbon::parse($accessToken->expire_date)->timestamp,
            "token_type" => "bearer",
            "scope"=>"full|".$accessToken->app_name.".infusionsoft.com"
        ]);
    }
    /* End of Token and auth methods */


    /**
     * Apply Tag
     *
     * @param $contactId
     * @param $tagId
     * @return bool
     */
    public function applyTagUsingTagId($contactId, $tagId){
        $this->checkIfRefreshTokenHasExpired();
        return $this->infusionsoftService->contacts('xml')->addToGroup($contactId, $tagId);
    }

    /**
     * Update Contact
     *
     * @param $id
     * @param $data
     * @return int|null
     * @result
     *  $result - should return the CONTACT ID
     */
    public function xmlUpdateContact($id,$data)
    {
        $this->checkIfRefreshTokenHasExpired();
        $result = null;

        try {
            $result = $this->infusionsoftService->contacts('xml')->update($id, $data);
        } catch (\Exception $e) {
            Log::error("INFS Update Contact Error: " . $e->getMessage());
        }

        return $result;
    }

    /**
     * @param $data
     * @param string $type
     * @return int|null
     */
    public function xmlAddWithDedupCheck($data, $type = 'Email')
    {
        $this->checkIfRefreshTokenHasExpired();
        $result = null;

        try {
            $result = $this->infusionsoftService->contacts('xml')->addWithDupCheck($data, $type);
        } catch (\Exception $e) {
            Log::error("INFS Add with Dup Check Error: " . $e->getMessage());
        }

        return $result;
    }

    /**
     * @param $email
     * @param $optInReason
     * @return bool|null
     */
    public function optIn($email, $optInReason)
    {
        $attempts = 1;
        $this->checkIfRefreshTokenHasExpired();

        try {

            $return_data = $this->infusionsoftService->emails('xml')->optIn($email, $optInReason);
            if(!isset($return_data) || is_null($return_data)){
                sleep(1);
            }

            return $return_data;

        } catch(\Exception $e) {
            do {
                try {

                    $result = $this->optIn($email, $optInReason);

                } catch (\Exception $fault) {

                    sleep(rand(2,4));
                    $attempts++;
                    continue;

                }
                break;
            } while ( $attempts < 3 );

        }
    }

}
