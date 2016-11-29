<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CounselorTest extends TestCase {

// ------------------------------------------------------------

  use DatabaseTransactions;

  public function setUp() {
    parent::setUp();
    // migrates before the first test...
    $this->artisan('migrate');

    // ...rolls back before the last test
    $this->beforeApplicationDestroyed(function () {
        $this->artisan('migrate:rollback');
    });

    // The golden vars
    $this->counselor = factory(App\Counselor::class)->create();
    $this->user = factory(App\User::class)->create();
  }


  /** @test if */
  public function the_factory_can_make_a_counselor() {
    $this->counselor->save();
    $this->seeInDatabase('counselors', ['first_name' => $this->counselor->first_name]);
  }

  /** @test if */
  public function a_counselor_can_be_created_through_the_constructor() {
    $counselor_deets = [
      'first_name' => 'Luke',
      'last_name' => 'Sweeney',
      'email' => 'example@example.example',
      'phone' => '9899899899',
      'unit_num' => '123',
      'bsa_id' => '123123123',
      'unit_only' => false,
      'ypt' => true,
    ];
    $counselor = new App\Counselor($counselor_deets);
    $this->assertEquals('Luke', $counselor->first_name);
  }

  /** @test if */
  public function a_counselor_can_be_created_from_a_request_object() {
    // TODO: Write a test for creating a counselor from a request object
    // this will require acceptance testing, probably.
    // something like visit('/add') with a post request and shit
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


  /** @test if */
  public function a_counselor_can_be_updated() {
    $this->counselor->first_name = 'Phila';
    $this->counselor->last_name = 'delphia';
    if ($this->counselor->first_name . $this->counselor->last_name == 'Philadelphia') {
      $this->assertTrue(true);
    }
  }

  /** @test if */
  public function a_counselor_can_return_their_full_name() {
    $fullName = $this->counselor->first_name . " " . $this->counselor->last_name;
    $this->assertEquals($fullName, $this->counselor->name());
  }

}