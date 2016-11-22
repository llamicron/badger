<?php

use App\Counselor;
use App\User;

// just realised that DatabaseTransaction will 'hold-over' the database and
// DatabaseMigrations will rollback and re-migrate them for every test.
// Knawledge

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CounselorTest extends TestCase {

  use DatabaseMigrations;

  /** @test if */
  public function the_factory_can_make_a_counselor() {
    $counselor = factory(Counselor::class)->create();
    $counselor->save();
    $this->seeInDatabase('counselors', ['first_name' => $counselor->first_name]);
  }

  /** @test if */
  public function a_counselor_can_belong_to_a_user()
  {
    $user = factory(User::class)->create();
    $counselor = factory(Counselor::class)->create();
    $user->counselors()->save($counselor);
    $this->assertEquals($user->id, $counselor->user_id);
  }



}