# ACCOUNT SERVICE API
This project is a API for managing accounts

## Prerequisites
Before running the application you need the following prerequisites:

* Php 8.1
* pg_sql
* pdo_pgsql (drivers to connect postgresql)
### Prerequisites to run docker compose

## API Endpoints
### Users
Create User
* Endpoint: POST /users
* Description: Create a new user
* Request Body: JSOM representation of the user to be created.
```Json
{
    "name": "New Name",
    "lastName": "Last Name",
    "email": "email@mail.com",
    "password": "password",
    "roleId": 1
}
```
email is unique
password will be hash
roleId references role table, and have to existis rol with id:1 (1), id:2 (trainee), id:3 (trainer)

## Set env
Your env need the following parameters:

```
JWT_KEY=<key>
JWT_ALGORTHM=<algorithm>
JWT_EXPIRE_MINUTES=<minutes>

DB_CONNECTION='pgsql:host=<host>;dbname=<db_name>'
DB_USERNAME='<db_username>'
DB_PASSWORD='<db_password>'
```
you can use HS256 <algorithm>

## Run Docker Compose
If you want run docker compose you need aply changes in your env
```
JWT_KEY=<key>
JWT_ALGORTHM=<algorithm>
JWT_EXPIRE_MINUTES=<minutes>

DB_CONNECTION='pgsql:host=database;dbname=<db_name>'
DB_USERNAME='<db_username>'
DB_PASSWORD='<db_password>'
```
