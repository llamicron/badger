<?php

// just realised that DatabaseTransaction will 'hold-over' the database and
// DatabaseMigrations will rollback and re-migrate them for every test.
// Knawledge

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CounselorTest extends TestCase {

  use DatabaseTransactions;

  public function setUp() {
    parent::setUp();
    $this->artisan('migrate');

    $this->beforeApplicationDestroyed(function () {
        $this->artisan('migrate:rollback');
    });
    $this->counselor = factory(App\Counselor::class)->create();
    $this->user = factory(App\User::class)->create();
  }

  // Counselor Specific Tests
  /** @test if */
  public function the_factory_can_make_a_counselor() {
    $this->counselor->save();
    $this->seeInDatabase('counselors', ['first_name' => $this->counselor->first_name]);
  }

  /** @test if */
  public function a_counselor_can_have_a_name() {
    $this->assertTrue(isset($this->counselor->first_name));
    $this->assertTrue(isset($this->counselor->last_name));
  }

  /** @test if */
  public function a_counselor_can_have_contact_information() {
    $this->assertTrue(isset($this->counselor->email));
    $this->assertTrue(isset($this->counselor->phone));
  }

  /** @test if */
  public function a_counselor_can_have_unit_information() {
    $this->assertTrue(isset($this->counselor->unit_num));
    $this->assertTrue(isset($this->counselor->bsa_id));
    $this->assertTrue(isset($this->counselor->unit_only));
    $this->assertTrue(isset($this->counselor->ypt));
  }


  // Counselor-User Tests

  /** @test if */
  public function a_counselor_can_belong_to_a_user() {
    $this->user->counselors()->save($this->counselor);
    $this->assertEquals($this->user->id, $this->counselor->user_id);
  }

  /** @test if */
  public function a_counselor_can_retrieve_the_user_it_belongs_to() {
    $this->user->counselors()->save($this->counselor);
    $oldId = $this->user->id;
    unset($this->user);

    // this is where the magic happens
    $this->assertEquals($oldId, $this->counselor->user->id);
  }



}