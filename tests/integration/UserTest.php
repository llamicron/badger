<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Counselor;

class UserTest extends TestCase {

// ---------------------------------------------------

  use DatabaseMigrations;

  /** @test if */
  public function the_factory_can_create_a_user() {
    $user = factory(User::class)->create();
    $user->save();
    $this->seeInDatabase('users', ['name' => $user->name]);
  }

  /** @test if */
  public function a_user_can_own_a_counselor() {
    // this is literally the same test as CounselorTest::a_counselor_can_belong_to_a_user
    // For verbosity i guess???
    $user = factory(User::class)->create();
    $counselor = factory(Counselor::class)->create();
    $user->counselors()->save($counselor);
    $this->assertEquals($user->id, $counselor->user_id);
  }

  /** @test if */
  public function a_user_can_retrieve_the_counselors_it_owns() {
    $user = factory(User::class)->create();
    $counselor = factory(Counselor::class)->create();
    $user->counselors()->save($counselor);

    $oldId = $counselor->id;
    unset($counselor);

    $this->assertEquals($oldId, $user->counselors->first()->id);
  }

  
}