<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterPageAvailable()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

//    public function testRegisterActionAvailable()
//    {
//        $response = $this->post('/register');
//
//        $response->assertRedirect(302);
//    }

    public function testRegisterAction():void
    {
        $email = Factory::create()->email;
        $name = 'teeeest';
        $password = '1234567890';

        DB::beginTransaction();

        $response = $this->post('register',[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));

        $user = User::whereEmail($email)->first();
        $this->assertNotNull($user);
        $this->assertEquals($user->name, $name);
        $this->assertNotEquals($user->password, $password);
        $this->assertTrue(password_verify($password, $user->password));

        if($user) DB::rollback();


    }
}
