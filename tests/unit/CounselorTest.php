<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CounselorTest extends TestCase {

  use DatabaseTransactions;

  public function setUp() {
    parent::setUp();
    $this->artisan('migrate');

    $this->beforeApplicationDestroyed(function () {
        $this->artisan('migrate:rollback');
    });

    // The golden vars
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


}