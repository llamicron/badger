# Testing Badger

DISCLAIMER: I suck at testing

phpunit (built-in to Laravel) is used to test Badger.
You can find details and test suite definitions in `phpunit.xml`

Tests are split into `integration`, `unit`, and `database`. You can read on the differences [here (hail stack overflow)](http://stackoverflow.com/questions/5357601/whats-the-difference-between-unit-tests-and-integration-tests)

## Database

A mock database is created specifically for testing. Look in `config/database.php`, under the `badger_testing.sqlite` for details about the database. But it's just sqlite, so nothing special.
For most tests, the database is migrated every time a test is run, and rolled back at the end of every test, so it's fresh for the next one. This is accomplished by using the `DatabaseMigrations` class.
In contrast, using the `DatabaseTransactions` class will do the opposite, and the changes will be persisted to the database for every test in that test class. For example, i could say:
```
class ModelTest extends TestCase {
  use DatabaseTransactions;

  public function setUp() {
    $this->model = new Model;
  }


  // returns true
  public function test_some_generic_test() {
    if(isset($this->model)) {
      return true;
    }
    return false;
  }

}
```
and for each test in the `ModelTest` class i would have access to `$this->model`.
This can be very useful for integration tests, where you don't want to have to build up your models every time you run a tests, and can improve test speeds.