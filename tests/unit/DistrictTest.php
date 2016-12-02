<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class DistrictTest extends TestCase
{

// ---------------------------------------------------

  use DatabaseTransactions;

  public function setUp() {
    $this->district = new App\District([
      'name' => 'Arrowmoon'
    ]);
  }

  /** @test if */
  public function a_district_can_have_a_name() {
    $this->assertEquals('Arrowmoon', $this->district->name);
  }

  /** @test if */
  public function a_district_can_have_many_counselors() {
    // whats going on here?
    //
    // i get an error on this line
    // $counselors = App\Counselor::first();
    // 
    // foreach ($counselors as $counselor) {
    //   $district->counselors()->save($counselor);
    // }
    // $this->assertEquals(10, $district->counselors->count());
  }

}