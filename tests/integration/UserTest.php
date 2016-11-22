<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class UserTest extends TestCase {

  use DatabaseMigrations;

  /** @test if */
  public function the_factory_can_create_a_user()
  {
    $user = factory(User::class)->create();
    $user->save();
    $this->seeInDatabase('users', ['name' => $user->name]);
  }


}