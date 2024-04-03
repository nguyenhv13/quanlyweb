<?php

namespace Tests\Unit\Auth;

// use PHPUnit\Framework\TestCase;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testIndexLogin()
    {
        $this->get('/login')->assertStatus(200)
            ->assertViewIs('auth.login');
    }
    # test rules
    public function testLoginFalseEmailNull()
    {
        $this->post('/login', [
            'email' => '',
            'password' => '123456789'
        ])->assertStatus(302);
        $errors = session('errors');
        $this->assertEquals($errors->get('email')[0], "The email field is required.");
    }
    public function testLoginFalsePasswordNull()
    {
        $this->post('/login', [
            'email' => 'Test@gmail.com',
            'password' => ''
        ])->assertStatus(302);
        $errors = session('errors');
        $this->assertEquals($errors->get('password')[0], "The password field is required.");
    }

    public function testLoginAdmin()
    {
        $faker = \Faker\Factory::create();
        $user = ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt('123456789'), 'role_name' => 'Admin'];
        User::factory()->create($user);
        $this->post('/login', [
            'email' => $user['email'],
            'password' => '123456789'
        ])->assertStatus(302)
            ->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }

    public function testLoginStudent()
    {
        $faker = \Faker\Factory::create();
        $user = ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt('123456789'), 'role_name' => 'Student'];
        User::factory()->create($user);
        $this->post('/login', [
            'email' => $user['email'],
            'password' => '123456789'
        ])->assertStatus(302)
            ->assertRedirect(route('homeStudent'));
        $this->assertAuthenticated();
    }

    public function testLoginTeacher()
    {
        $faker = \Faker\Factory::create();
        $user = ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt('123456789'), 'role_name' => 'Teacher'];
        User::factory()->create($user);
        $this->post('/login', [
            'email' => $user['email'],
            'password' => '123456789'
        ])->assertStatus(302)
            ->assertRedirect(route('homeTeacher'));
        $this->assertAuthenticated();
    }

    public function testLoginFalseEmailFalse()
    {
        $user = User::created([
            'email' => 'test123@gmail.com',
            'password' => '123456789'
        ]);
        $response = $this->post('/login',[
            'email' => 'testabcd123@gmail.com',
            'password' => '123456789'
        ])
        ->assertStatus(302);
        $response->assertSessionHas('message','');
    }

    public function testLogout()
    {
        $faker = \Faker\Factory::create();
        $user = ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt('123456789'), 'role_name' => 'Teacher'];
        User::factory()->create($user);
        $this->post('/login', [
            'email' => $user['email'],
            'password' => '123456789'
        ])->assertStatus(302)
            ->assertRedirect(route('homeTeacher'));
        $this->assertAuthenticated();
        $this->get('/logout')->assertRedirect(route('login'));
    }
}
