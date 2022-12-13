# Requirements
- Docker
- Docker Compose

# Run project

## Prepare host file
- Add project.loc to your hosts file
    - 127.0.0.1 project.loc
## Start Docker's containers
- Execute below command in the terminal / cmd
    ```
    docker-compose up -d
    ```
## Install dependencies 
- Enter to the Apache and PHP container
    ```
    docker exec -it apache_php bash
    ```
- execute command to set permissions:
    ```
    chown www-data:www-data /var/www/html/storage -R
    ```
- Install required libraries by composer 
    ```
    composer install
    ```
- Create and migrate database
    ```
    php artisan migrate
    ```
- Seed the database
    ```
    php artisan db:seed
    ```
- Generate access token for authorization:
    ```
    php artisan passport:install
    ```
# Requests to API:
## get all users data
### request
- this endpoint need's authorization with Barrer token
- use accept header with application/json value
- GET: http://project.loc/api/user
### response
- show softly deleted user's data
- example response:
{
    "data": [
        {
            "id": 1,
            "name": "admin",
            "email": "admin@mail.loc",
            "email_verified_at": "2022-12-10T22:30:15.000000Z",
            "created_at": "2022-12-10T22:30:15.000000Z",
            "updated_at": "2022-12-10T22:30:15.000000Z",
            "deleted_at": null
        },
        {
            "id": 2,
            "name": "Theodor Kowalski",
            "email": "tkowalski@mail.loc",
            "email_verified_at": null,
            "created_at": "2022-12-10T22:33:15.000000Z",
            "updated_at": "2022-12-10T22:33:15.000000Z",
            "deleted_at": null
        }
    ]
}
## get user data
### request
- GET: http://project.loc/api/user/[userID]
    - example:
    ```
    http://project.loc/api/user/2
    ```
### response
- don't show softly deleted user's
    - example response:
    {
        "id": 2,
        "name": "Theodor Kowalski",
        "email": "tkowalski@mail.loc",
        "email_verified_at": null,
        "created_at": "2022-12-10T22:33:15.000000Z",
        "updated_at": "2022-12-10T22:33:15.000000Z",
        "deleted_at": null
    }
## edit some user's data
### request
- you can edit data like:
    - name
    - password
    - email
- PATCH: http://project.loc/api/user/[userID]
## delete user
### request
- DELETE: http://project.loc/api/user/[userID]
## create user
### request
- POST: http://project.loc/api/user/
- example:
{
    "name": "Tadeusz P",
    "email": "email@loc",
    "password": "difficult_password"
}
## authorization
### request
- POST: http://project.loc/oauth/token
- example
{
    "grant_type": "password",
    "client_id": 2,
    "client_secret": "PpJvcSBDWGN3Q6rY2SmCsOFt4G1eJJVrrAotsEi5",
    "username": "admin@mail.loc",
    "password": "password",
    "scope":""
}
    
    
