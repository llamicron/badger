<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class BadgeTest extends TestCase {

  use DatabaseMigrations;

  /** @test if */
  public function a_counselor_can_add_a_badge() {
    $counselor = factory(App\Counselor::class)->create();
    $badge = factory(App\Badge::class)->create();

    $counselor->badges()->save($badge);

  }


}