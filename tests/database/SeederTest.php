<?php

use App\Counselor;
use App\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class SeederTest extends TestCase
{

  use DatabaseMigrations;

  /** @test if */
  public function the_seeders_can_run() {
    Artisan::call('db:seed');
  }

  /** @test if */
  public function the_model_factory_can_create_things() {
    $user = factory(App\User::class)->create();
    $counselor = factory(App\Counselor::class)->create();
    if ($user && $counselor) {
      $this->assertTrue(true);
    } else {
      $this->assertTrue(false);
    }
  }

  

}