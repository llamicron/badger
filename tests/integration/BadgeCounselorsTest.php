<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class BadgeCounselorTest extends TestCase {

// ---------------------------------------------

  use DatabaseMigrations;

  /** @test if */
  public function a_counselor_can_add_a_badge() {
    $counselor = factory(App\Counselor::class)->create();
    $badge = factory(App\Badge::class)->create();

    $counselor->badges()->save($badge);

    $this->seeInDatabase('badge_counselor', [
      'badge_id' => $badge->id,
      'counselor_id' => $counselor->id,
    ]);

  }

  /** @test if */
  public function a_counselor_can_retrieve_thier_badges() {
    $counselor = factory(App\Counselor::class)->create();
    $badge = factory(App\Badge::class)->create();
    $oldId = $badge->id;

    $counselor->badges()->save($badge);
    unset($badge);

    $this->assertEquals($oldId, $counselor->badges->first()->id);
  }

}