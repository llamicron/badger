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
        $this->call(UsersTableSeeder::class);
        $this->call(CounselorsTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder {
  public function run() {
    for ($i=0; $i < 20; $i++) {
      $user = factory(App\User::class)->create()->save();
    }
  }
}

class CounselorsTableSeeder extends Seeder {
  public function run() {
    for ($i=0; $i < 50; $i++) {
      $counselor = factory(App\Counselor::class)->create()->save();
    }
  }
}