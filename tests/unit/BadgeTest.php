<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class BadgeTest extends TestCase {

// -----------------------------------------

  use DatabaseTransactions;

  public function setUp() {
    parent::setUp();
    $this->artisan('migrate');

    $this->beforeApplicationDestroyed(function () {
        $this->artisan('migrate:rollback');
    });

    $this->badge = factory(App\Badge::class)->create();
    $this->counselor = factory(App\Counselor::class)->create();
  }

  /** @test if */
  public function the_factory_can_create_a_badge() {
    $badge = factory(App\Badge::class)->create();
    $this->assertTrue(isset($badge));
  }

}