> # Learn Laravel

-   Installations and Documentation: https://laravel.com/docs/11.x/installation

-   Creating a new laravel Project

```bash
laravel new  project-name
```

# Database Connection

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

# Routes

-   They can be for console, web and apis,
-   They take in the path that the user wants to access and returns a callback function containing the result
-   The web returns a method called **View** which takes in the name of the view you want to display
    -   All Views are in the **resources/views** directory
