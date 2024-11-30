> # Learn Laravel

-   Installations and Documentation: https://laravel.com/docs/11.x/installation

-   Creating a new laravel Project

```bash
laravel new  project-name
```

## Database Connection

-   In env you can setup your database connection

## Using sqlite

-   Create file called database.sqlite in this folder as database/database.sqlite
-   Open the .env file and change MySQL to SQLite
-   Comment password and username and databaseName
-   run php artisan migrate enjoy

```env
DB_CONNECTION=sqlite

#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=database
#DB_USERNAME=doj
#DB_PASSWORD=password
```

-   If you do not have sqlite installed, you can install using the folklowing command:

```bash
sudo apt-get install php-sqlite3
```
