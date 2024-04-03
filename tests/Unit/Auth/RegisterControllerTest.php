<?php

namespace Tests\Unit\Auth;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
class RegisterControllerTest extends TestCase
{

    public function testGetViewEmail(){
        $this->get('/forget-password')
        ->assertStatus(200)
        ->assertViewIs('auth.passwords.email');
    }

    public function testPostEmail()
    {

    }
}
