# Counselor Model

The counselor model is the main model for this application. It will be referred to as Counselor throughout this documentation. The Counselor class definition, like all other models, is located in the `app` directory, i.e. `app/Counselor.php`

## Database
The schema is as follows:

Columns in `counselors` table:
* id - increment
* first_name - string
* last_name - string
* email - string
* phone - string
* unit_num - integer
* bsa_id - integer
* unit_only - boolean (default false)
* ypt - boolean (default false)
* user_id - integer
* timestamp

Note: In [MBCDB,](https://github.com/SelectiveAlso/mbcdb) more information was stored on Counselor, like `address`, `city`, `state`, `zip`, `secondary_phone`, etc.
This is not the case for Badger, as it simplifies things, and requires less information from the end user.

## Relationships
### Counselor-User
The Counselor model has a many-to-one relationship with the User model. A user can have many counselors, but a counselor can only belong to one user, as evident in `app/Counselor.php`
```
public function user() {
  return $this->belongsTo(User::class);
}
```
And the reverse in `app/User.php`

### Counselor-Badge
The Counselor model has a many-to-many relationship with the Badge model. A counselor can have many badges, and a badge instance can belong to many counselors, as evident in `app/Counselor.php`
```
public function badges() {
  return $this->belongsToMany(Badge::class);
}
```
and the reverse in `app/Badge.php`

### Counselor-User through Save
The Save model is a bit special, you can find documentation on it in `docs/models/Save.md`.
The model spec is located in `app/Save.php`