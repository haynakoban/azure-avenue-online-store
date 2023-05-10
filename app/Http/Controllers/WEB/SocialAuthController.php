<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();
        
        // check if they are an existing user
        $existingUser = User::where('provider_id', $socialUser->id)->orWhere('email', $socialUser->email)->first();

        if ($existingUser) {
            // update user
            $existingUser->provider_id = $socialUser->id;
            $existingUser->provider = $provider;
            $existingUser->provider_token = $socialUser->token;
            $existingUser->save();

            Auth::login($existingUser);
        }
      
        else {
            // create new user
            $newUser = User::create([
                'provider_id' => $socialUser->id,
                'provider' => $provider,
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'provider_token' => $socialUser->token,
            ]);

            Auth::login($newUser);
        }

        return redirect()->back();
    }
}
