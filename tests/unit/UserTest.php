<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

// TODO: Convert this to DatabaseTransactions

class UserTest extends TestCase {

// ---------------------------------------------------

  use DatabaseMigrations;

  /** @test if */
  public function the_factory_can_create_a_user() {
    $user = factory(App\User::class)->create();
    $user->save();
    $this->seeInDatabase('users', ['name' => $user->name]);
  }

  /** @test if */
  public function a_user_can_have_a_name() {
    $user = factory(App\User::class)->create();
    $this->assertTrue(isset($user->name));
  }

  /** @test if */
  public function a_user_can_have_an_email() {
    $user = factory(App\User::class)->create();
    $this->assertTrue(isset($user->email));
  }

  /** @test if */
  public function a_user_can_have_a_password() {
    $user = factory(App\User::class)->create();
    $this->assertTrue(isset($user->password));
  }

  /** @test if */
  public function a_user_can_be_verified() {
    $user = factory(App\User::class)->create();
    $this->assertFalse($user->verified);
    $user->verified = true;
    $this->assertTrue($user->verified);
  }

  /** @test if */
  public function a_user_can_not_access_the_site_when_they_are_not_verified() {
    // TODO: This
    $this->assertTrue(true);
  }

  /** @test if */
  public function a_user_can_have_a_unique_token() {
    $user = factory(App\User::class)->create();
    $this->assertTrue(isset($user->token));
  }

  /** @test if */
  public function a_user_can_own_a_counselor() {
    // this is literally the same test as CounselorTest::a_counselor_can_belong_to_a_user
    // For verbosity i guess???
    $user = factory(App\User::class)->create();
    $counselor = factory(App\Counselor::class)->create();
    $user->counselors()->save($counselor);
    $this->assertEquals($user->id, $counselor->user_id);
  }

  /** @test if */
  public function a_user_can_retrieve_the_counselors_it_owns() {
    $user = factory(App\User::class)->create();
    $counselor = factory(App\Counselor::class)->create();
    $user->counselors()->save($counselor);

    $oldId = $counselor->id;
    unset($counselor);

    $this->assertEquals($oldId, $user->counselors->first()->id);
  }

  /** @test if */
  public function a_counselor_cannot_retrieve_its_user_if_the_user_was_deleted() {
    $user = factory(App\User::class)->create();
    $counselor = factory(App\Counselor::class)->create();

    $user->counselors()->save($counselor);
    // referencing $counselor->user breaks this test. Eager loading maybe?
    // Test is fine without it though.
    // $counselor->user;
    $user->delete();

    $this->assertEquals(null, $counselor->user);
  }



}