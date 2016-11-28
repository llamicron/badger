# User Model

The User Model will be referred to as User throughout this documentation.
The definition of this model can be found at `app/User.php`

## Database Schema
The database schema is as follows:
Columns in `Users` table:
* id - string (a short hash)
* name - string
* email - string
* password - string (bcrypt hash)
* token - string (unique to the user. Used for activation and such)
* verified - boolean
* timestamp

## Relationships
### User-Counselor
See `docs/models/Counselor.md`
The User model has a many-to-one relationship with the Counselor model. A user can have many counselors, but a counselor can only belong to one user, as evident in `app/User.php`
```php
// returns a collection of counselors 'owned' by the user
public function counselors() {
  return $this->hasMany(Counselor::class);
}
```
And the reverse in `app/Counselors.php`
