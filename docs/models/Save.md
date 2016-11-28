# Save Model

The Save Model will be referred to as Save throughout this documentation.
The definition of this model can be found at `app/Save.php`
Save is a different model. It is basically a glorified pivot table.
On the front end, when a user 'saves' a counselors, a transaction is added here, storing the user id and the counselor id. The user can then retrieve the collection of counselors that they have saved, even though they do not 'own' the counselor.

## Database Schema
The database schema is as follows:
Columns in `saves` table:
<!-- TODO: write documentation for the saves table that doesn't exist yet. -->

## Relationships

## User-Save-Counselor
<!-- TODO: Write documentation for Save relationships. Also, understand it better. -->