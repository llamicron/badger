<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
      if (env('PRODUCTION') === false) {
        // run dev seeders
        $this->call(DevUsersTableSeeder::class);
        $this->call(DevCounselorsTableSeeder::class);
        $this->call(DevCounselorsToUsersSeeder::class);
        $this->call(DevBadgesTableSeeder::class);
      } else {
        // run prod seeders
        // $this->call(ProdBadgesTableSeeder::class);
      }
    }
}

class DevUsersTableSeeder extends Seeder {
  public function run() {
    for ($i=0; $i < 20; $i++) {
      $user = factory(App\User::class)->create()->save();
    }
  }
}

class DevCounselorsTableSeeder extends Seeder {
  public function run() {
    for ($i=0; $i < 60; $i++) {
      $counselor = factory(App\Counselor::class)->create()->save();
    }
  }
}

class DevCounselorsToUsersSeeder extends Seeder {
  public function run() {
    for ($i=0; $i < 20; $i++) {
      foreach (App\User::get() as $user) {
        $counselor = App\Counselor::inRandomOrder()->first();
        $user->counselors()->save($counselor);
      }
    }
  }
}

class DevBadgesTableSeeder extends Seeder {
  public function run() {
    for ($i=0; $i < 120; $i++) {
      $badge = factory(App\Badge::class)->create();
      $badge->save();
    }
  }
}