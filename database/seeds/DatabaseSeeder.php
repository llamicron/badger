<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if (env('PRODUCTION') === true) {
        // run prod seeders

      } else {
        // run dev seeders
        $this->call(DevUsersTableSeeder::class);
        $this->call(DevCounselorsTableSeeder::class);
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
    for ($i=0; $i < 50; $i++) {
      $counselor = factory(App\Counselor::class)->create()->save();
    }
  }
}