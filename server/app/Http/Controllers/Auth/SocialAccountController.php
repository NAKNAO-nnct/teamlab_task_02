<?php

namespace App\Http\Controllers\Auth;

ini_set('display_errors', "On");

use App\SocialAccountsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialAccountController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(\App\SocialAccountsService $accountService, $provider)
    {
        try {
            $user = \Socialite::with($provider)->user();
            $token = $user->token;
            $refreshToken = $user->refreshToken;
            $expiresIn = $user->expiresIn;
        } catch (\Exception $e) {
            //	echo $e;
            //	return ;
            return redirect('/login');
        }

        $user = \Socialite::with($provider)->userFromToken($token);

        $authUser = $accountService->findOrCreate(
            $user,
            $provider
        );

        // print_r($user);

        auth()->login($authUser, true);

        return redirect()->to('/');
    }
}
