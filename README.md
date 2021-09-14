# CSV Mapper

# Prerequisites
1. PHP
2. Composer

# Installation
1. Copy the code to your system.
2. Open terminal inside the project folder.
3. Run "composer install" inside the directory to install dependencies.

# Running the Application
1. Run "php -S localhost:8000 -t public" inside the project directory to get the application started on localhost:8000
2. Open another terminal within project directory and run command "php artisan generate:json 'file'" . Here it is important to note that file refers to the file path / location.
3. Running the above command creates items.json file inside storage/app/public/ folder.
4. The below mentioned are the list of APIs available:
   
    Path                                    Usage
    ----------------------------------------------
    /getItems                               List all the items in items.json in json format
    /getItemsxml                            List all the items in items.json in xml format

    /getItems/name/{name}                   Filter items on name (name should be given as parameter)
    /getItemsxml/name/{name}                Same as above in xml format

    /getItems/pvp/{pvp}                     Filter items on pvp (pvp should be given as parameter)
    /getItemsxml/pvp/{pvp}                  Same as above in xml format