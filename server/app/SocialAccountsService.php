<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountsService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $account = LinkedSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        // print_r($account->user);

        if ($account) {
            // print_r($account->user);
            return $account->user;
        } else {

            $user = User::where('id', $providerUser->getId())->first();

            if (!$user) {
                $user = User::create([
                    'id' => $providerUser->getId(),
                    'email' => $providerUser->getEmail(),
                    'name'  => $providerUser->getName(),
                    'avatar' => $providerUser->getAvatar(),
                    'nickname' => $providerUser->getNickname()
                ]);
            }

            $user->accounts()->create([
                'provider_id'   => $providerUser->getId(),
                'provider_name' => $provider
            ]);

            // print_r($providerUser->getAvatar());

            return $user;
        }
    }
}
