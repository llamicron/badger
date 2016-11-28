<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserCounselorTest extends TestCase {

// ---------------------------------------------

  use DatabaseMigrations;

  /** @test if */
  public function a_counselor_can_belong_to_a_user() {
    $user = factory(App\User::class)->create();
    $counselor = factory(App\Counselor::class)->create();
    $user->counselors()->save($counselor);
    $this->assertEquals($user->id, $counselor->user_id);
  }

  /** @test if */
  public function a_counselor_can_retrieve_the_user_it_belongs_to() {
    $user = factory(App\User::class)->create();
    $counselor = factory(App\Counselor::class)->create();
    $user->counselors()->save($counselor);
    $oldId = $user->id;
    unset($user);

    // this is where the magic happens
    $this->assertEquals($oldId, $counselor->user->id);
  }

  /** @test if */
  public function a_user_can_retrieve_the_counselors_it_owns() {
    $user = factory(App\User::class)->create();
    for ($i=0; $i < 3; $i++) {
      $counselor = factory(App\Counselor::class)->create();
      $user->counselors()->save($counselor);
    }
    $oldId = $user->counselors->first()->id;
    unset($user);

    $user = App\User::first();
    $this->assertEquals($oldId, $user->counselors->first()->id);

  }

}