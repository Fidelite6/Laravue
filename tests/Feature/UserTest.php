<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    protected $user;

    public function setUp()
    {
        $this->user = new User();
    }

    /** @test */
    public function userSetName()
    {
        $this->user->setFirstName('Jack');

        $this->assertEquals($this->user->name, 'Jack');
    }

    /** @test */
    public function isNameIsTrimmed()
    {
        $this->user->setFirstName('   Jack    ');

        $this->assertEquals($this->user->name, 'Jack');
    }

}
