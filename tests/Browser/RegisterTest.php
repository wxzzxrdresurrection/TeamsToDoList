<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use RefreshDatabase;

    public function testRegisterWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->press('Registrarse aquí')
            ->assertSee('El usuario es obligatorio')
            ->assertSee('El correo es obligatorio')
            ->assertSee('La contraseña es obligatoria')
            ->assertSee('La confirmación de contraseña es obligatoria')
            ->screenshot('register-with-empty-inputs');
        });
    }
    public function testRegisterSuccessfully(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('username', 'luiszapata')
                ->type('email', 'luiszapata0815@gmail.com')
                ->type('password', 'Luis#200315')
                ->type('passwordConfirmation', 'Luis#200315')
                ->press('Registrarse aquí')
                ->waitForText('Registro correcto',10)
                ->assertSee('Usuario registrado correctamente')
                ->screenshot('register-successfully');
        });
    }

    public function testRegisterWithCorrectRedirect(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('username', 'luisz')
                ->type('email', 'luiszapata08@gmail.com')
                ->type('password', 'Luis#200315')
                ->type('passwordConfirmation', 'Luis#200315')
                ->press('Registrarse aquí')
                ->waitForText('Registro correcto',10)
                ->clickAtPoint(0,0)
                ->screenshot('register-redirect');

        });
    }
}
