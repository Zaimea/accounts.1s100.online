<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Livewire\Livewire;
use Zaimea\Accounts\Features;
use Zaimea\Accounts\Accounts;

class AppServiceProvider extends ServiceProvider
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
        Vite::prefetch(concurrency: 3);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'view');

        Accounts::viewAuthPrefix('users.auth.');
        Accounts::viewUserPrefix('users.views.');

        if (class_exists(Passport::class)) {
            Passport::viewPrefix('users.auth.oauth.');
        }

        Blade::component('guest-layout', \App\View\Components\GuestLayout::class);
        Blade::component('app-layout', \App\View\Components\AppLayout::class);

        if (Features::hasApiFeatures()) {
            Livewire::component('api.api-token-manager', \App\Livewire\User\PassportApiTokenManager::class);

            Livewire::component('oauth.oauth-app-manager', \App\Livewire\User\OAuthAppManager::class);
            Livewire::component('oauth.oauth-connection-manager', \App\Livewire\User\OAuthConnectionManager::class);
        }
        Livewire::component('profile.update-profile-information-form', \App\Livewire\User\UpdateProfileInformationForm::class);
        Livewire::component('profile.update-password-form', \App\Livewire\User\UpdatePasswordForm::class);
        Livewire::component('profile.two-factor-authentication-form', \App\Livewire\User\TwoFactorAuthenticationForm::class);
        Livewire::component('profile.logout-other-browser-sessions-form', \App\Livewire\User\LogoutOtherBrowserSessionsForm::class);
        Livewire::component('profile.delete-user-form', \App\Livewire\User\DeleteUserForm::class);

        Blade::component('action-message', \App\Livewire\Components\ActionMessage::class);
        Blade::component('action-section', \App\Livewire\Components\ActionSection::class);
        Blade::component('application-logo', \App\Livewire\Components\ApplicationLogo::class);
        Blade::component('application-mark', \App\Livewire\Components\ApplicationMark::class);
        Blade::component('authentication-card', \App\Livewire\Components\AuthenticationCard::class);
        Blade::component('authentication-card-logo', \App\Livewire\Components\AuthenticationCardLogo::class);
        Blade::component('banner', \App\Livewire\Components\Banner::class);
        Blade::component('button', \App\Livewire\Components\Button::class);
        Blade::component('checkbox', \App\Livewire\Components\Checkbox::class);
        Blade::component('confirmation-modal', \App\Livewire\Components\ConfirmationModal::class);
        Blade::component('image-preview-modal', \App\Livewire\Components\ImagePreviewModal::class);
        Blade::component('confirms-password', \App\Livewire\Components\ConfirmsPassword::class);
        Blade::component('danger-button', \App\Livewire\Components\DangerButton::class);
        Blade::component('darkmode', \App\Livewire\Components\Darkmode::class);
        Blade::component('dialog-modal', \App\Livewire\Components\DialogModal::class);
        Blade::component('dropdown', \App\Livewire\Components\Dropdown::class);
        Blade::component('dropdown-link', \App\Livewire\Components\DropdownLink::class);
        Blade::component('form-section', \App\Livewire\Components\FormSection::class);
        Blade::component('input', \App\Livewire\Components\Input::class);
        Blade::component('input-search', \App\Livewire\Components\InputSearch::class);
        Blade::component('input-error', \App\Livewire\Components\InputError::class);
        Blade::component('label', \App\Livewire\Components\Label::class);
        Blade::component('label-line', \App\Livewire\Components\LabelLine::class);
        Blade::component('modal', \App\Livewire\Components\Modal::class);
        Blade::component('nav-link', \App\Livewire\Components\NavLink::class);
        Blade::component('responsive-nav-link', \App\Livewire\Components\ResponsiveNavLink::class);
        Blade::component('secondary-button', \App\Livewire\Components\SecondaryButton::class);
        Blade::component('section-border', \App\Livewire\Components\SectionBorder::class);
        Blade::component('section-border-low', \App\Livewire\Components\SectionBorderLow::class);
        Blade::component('section-title', \App\Livewire\Components\SectionTitle::class);
        Blade::component('select', \App\Livewire\Components\Select::class);
        Blade::component('selected-list', \App\Livewire\Components\SelectedList::class);
        Blade::component('sidebar-link', \App\Livewire\Components\SidebarLink::class);
        Blade::component('switchable-lang', \App\Livewire\Components\SwitchableLang::class);
        Blade::component('textarea', \App\Livewire\Components\Textarea::class);
        Blade::component('validation-errors', \App\Livewire\Components\ValidationErrors::class);
        Blade::component('welcome', \App\Livewire\Components\Welcome::class);

        Livewire::component('user-notifications', \App\Livewire\UserNotifications::class);
        Livewire::component('navigation-menu', \App\Livewire\NavigationMenu::class);
        Livewire::component('footer', \App\Livewire\Footer::class);

    }
}
