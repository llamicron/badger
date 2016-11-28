<?php

use App\Counselor;
use App\User;

// just realised that DatabaseTransaction will 'hold-over' the database and
// DatabaseMigrations will rollback and re-migrate them for every test.
// Knawledge

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CounselorTest extends TestCase {

  use DatabaseMigrations;


  // Counselor Specific Tests
  /** @test if */
  public function the_factory_can_make_a_counselor() {
    $counselor = factory(Counselor::class)->create();
    $counselor->save();
    $this->seeInDatabase('counselors', ['first_name' => $counselor->first_name]);
  }

  /** @test if */
  public function a_counselor_can_have_a_name() {
    $counselor = factory(Counselor::class)->create();
    $this->assertTrue(isset($counselor->first_name));
    $this->assertTrue(isset($counselor->last_name));
  }

  /** @test if */
  public function a_counselor_can_have_contact_information() {
    $counselor = factory(Counselor::class)->create();
    $this->assertTrue(isset($counselor->email));
    $this->assertTrue(isset($counselor->phone));
  }

  /** @test if */
  public function a_counselor_can_have_unit_information() {
    $counselor = factory(Counselor::class)->create();
    $this->assertTrue(isset($counselor->unit_num));
    $this->assertTrue(isset($counselor->bsa_id));
    $this->assertTrue(isset($counselor->unit_only));
    $this->assertTrue(isset($counselor->ypt));
  }



  // Counselor-User Tests

  /** @test if */
  public function a_counselor_can_belong_to_a_user() {
    $user = factory(User::class)->create();
    $counselor = factory(Counselor::class)->create();
    $user->counselors()->save($counselor);
    $this->assertEquals($user->id, $counselor->user_id);
  }

  /** @test if */
  public function a_counselor_can_retrieve_the_user_it_belongs_to() {
    $counselor = factory(Counselor::class)->create();
    $user = factory(User::class)->create();

    $user->counselors()->save($counselor);
    $oldId = $user->id;
    unset($user);

    // this is where the magic happens
    $this->assertEquals($oldId, $counselor->user->id);
  }



}