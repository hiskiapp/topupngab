<?php

namespace Tests\Browser;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthenticationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_login_screen_can_be_rendered()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                    ->assertSee('Sign In');
        });
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visitRoute('login')
                    ->type('email', $user->email)
                    ->type('password', '123456')
                    ->press('Sign In')
                    ->assertPathIs(RouteServiceProvider::HOME);
        });
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visitRoute('login')
                    ->type('email', $user->email)
                    ->type('password', 'wrong-password')
                    ->press('Sign In')
                    ->assertPathIs('/login');
        });
    }
}
