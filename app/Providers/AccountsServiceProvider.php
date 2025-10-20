<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Zaimea\Accounts\Fabric\Actions\Auth\CreateNewUser;
use Zaimea\Accounts\Fabric\Actions\Auth\DeleteUser;
use Zaimea\Accounts\Fabric\Actions\Auth\RedirectIfTwoFactorAuthenticatable;
use Zaimea\Accounts\Fabric\Actions\Auth\ResetUserPassword;
use Zaimea\Accounts\Fabric\Actions\Auth\UpdateUserPassword;
use Zaimea\Accounts\Fabric\Actions\Passport\CreateClient;
use Zaimea\Accounts\Fabric\Actions\Passport\UpdateClient;
use Zaimea\Accounts\Fabric\Configuration\Singleton as FabricSingleton;
use Zaimea\Accounts\Features;
use Zaimea\Accounts\User\Actions\CreateUserApiToken;
use Zaimea\Accounts\User\Actions\DeleteUserProfilePhoto;
use Zaimea\Accounts\User\Actions\SendUserEmailVerification;
use Zaimea\Accounts\User\Actions\UpdateUserProfileInformation;
use Zaimea\Accounts\User\Configuration\Singleton as UserSingleton;

class AccountsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerFabricSingleton();
        $this->registerUserSingleton();

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('verification', function (Request $request) {
            return Limit::perMinute(6)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Register the application singleton's from fabric.
     *
     * @return void
     */
    public function registerFabricSingleton(): void
    {
        FabricSingleton::createUsersUsing(CreateNewUser::class);
        FabricSingleton::deleteUsersUsing(DeleteUser::class);
        FabricSingleton::updateUserPasswordsUsing(UpdateUserPassword::class);
        FabricSingleton::resetUserPasswordsUsing(ResetUserPassword::class);
        FabricSingleton::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        if (Features::hasApiFeatures()) {
            FabricSingleton::createOAuthClientsUsing(CreateClient::class);
            FabricSingleton::updateOAuthClientsUsing(UpdateClient::class);
        }
    }

    /**
     * Register the application singleton's from user.
     *
     * @return void
     */
    public function registerUserSingleton(): void
    {
        UserSingleton::sendUserEmailVerificationUsing(SendUserEmailVerification::class);
        UserSingleton::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        UserSingleton::deleteUserProfilePhotoUsing(DeleteUserProfilePhoto::class);
        UserSingleton::createPassportTokenUsing(CreateUserApiToken::class);
    }
}
