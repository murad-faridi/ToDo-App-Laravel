<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TodoTest extends DuskTestCase
{
    /**
     * Test user registration process
     * Check whether the user is redirected to the dashboard
     * 
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function ($browser) {
            $browser->visit('register')
                ->type('name', 'Tayor Otwell')
                ->type('email', 'taylor@laravel.com')
                ->type('password', 'ahmedkhan')
                ->type('password_confirmation', 'ahmedkhan')
                ->attach('userimage', 'C:\images\taylor.jpg')
                ->press('Register')
                ->assertPathIs('/todo');
        });
    }

    public function testCreateTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                ->clickLink('Add Todo')
                ->type('todo', 'Testing it With Dusk')
                ->type('category', 'dusk')
                ->type('description', 'This is created with dusk')
                ->press('Add')
                ->assertPathIs('/todo');
        });
    }

    public function testViewTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                ->assertVisible('#view1')
                ->visit(
                $browser->attribute('#view1', 'href')
            )
                ->assertPathIs('/todo/1')
                ->clickLink('Edit')
                ->type('description', 'Testing it with dusk again')
                ->press('Update')
                ->assertPathIs('/todo/1');
        });
    }

    public function testEditTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                ->assertVisible('#edit1')
                ->visit(
                $browser->attribute('#edit1', 'href')
            )
                ->type('description', 'Testing it with dusk again')
                ->press('Update')
                ->assertPathIs('/todo/1');
        });
    }

    public function testDeleteTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                ->assertVisible('#delete1')
                ->visit(
                $browser->attribute('#delete1', 'href')
            )
                ->assertPathIs('/todo');
        });
    }

    public function testLogout()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                ->clickLink('Logout')
                ->assertPathIs('/login');
        });
    }

    public function testLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('login')
                ->type('email', 'tessa@cloudways.com')
                ->type('password', 'ahmedkhan')
                ->press('Login')
                ->assertPathIs('/todo');
        });
    }
}
