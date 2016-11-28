# Testing Badger

DISCLAIMER: I suck at testing

phpunit (built-in to Laravel) is used to test Badger.
You can find details and test suite definitions in `phpunit.xml`

Tests are split into `integration`, `unit`, and `database`. You can read on the differences [here (hail stack overflow)](http://stackoverflow.com/questions/5357601/whats-the-difference-between-unit-tests-and-integration-tests)

## Database

A mock database is created specifically for testing. Look in `config/database.php`, under the `badger_testing.sqlite` array item for details about the database. But it's just sqlite, so nothing special.
For most tests, the database is migrated every time a test is run, and rolled back at the end of every test, so it's fresh for the next one. This is accomplished by using the `DatabaseMigrations` class, like so:
```php
class ModelTest extends TestCase {

  use DatabaseMigrations;

  // no setup function needed

  public function test_a_model_can_do_this() {
    // the database is migrated and is empty at this point
    $model = factory(App\User::class)->create();
    $this->actingAs($user);
    $this->visit('/')...
    // your amazing integration test
  } // the database is rolled-back

  public function test_a_model_can_do_that() {
    // the database is re-migrated, so it's empty again.
    $this->visit('/')...
    // another amazing integration test
  } // database is rolled back again

}
```
In contrast, using the `DatabaseTransactions` class will do the opposite, and the changes will be persisted to the database for every test in that test class. For example, i could say:
```php
class UserTest extends TestCase {

  use DatabaseTransactions;

  public function setUp() {
    $this->user = new User;
  }


  // returns true
  public function test_some_generic_test() {
    if(isset($this->user)) {
      return true;
    }
    return false;
  }

  // returns "it's still here"
  public function test_some_other_generic_test() {
    if(isset($this->user)) {
      return "it's still here";
    } else {
      return "it's gone";
    }
  }

}
```
and for each test in the `UserTest` class I would have access to `$this->`.
This can be very useful for integration tests, where you don't want to have to build up your models every time you run a tests, and can improve test speeds.

Hint: This is used in `tests/unit/CounselorTest.php`, check it out.