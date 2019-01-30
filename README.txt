dam2t01 : d4m2+5tc0m$r
dam2t02 : d4m2+5tc0m!2
dam2t03 : d4m2+5tc0mr&
dam2t04 : d4m2+5tc0mf$
dam2t05 : d4m2+5tc0mg(
dam2t06 : d4m2+5tc0m=b
dam2t07 : d4m2+5tc0m%d
dam2t08 : d4m2+5tc0m.d
dam2t09 : d4m2+5tc0m=7
dam2t10 : d4m2+5tc0m3#


# FIRST STEPS:

1)  Clone the source code repo:

        git clone dam2tXX@stucom.flx.cat:/home/dam2tXX/git/api_src.git

2)  Update the following files with your username (and password):

        ~/api/web/.htaccess
        ~/api/composer.json
        ~/api/model/propel.yml

3)  Log in the server and modify the ~/.my.cnf with your credentials

4)  Get the modifications of code and prepare the environment:

        cd ~/api
        git pull
        composer update
        srvUpdateSchema

5)  Enter sample data to the database

        cd ~/api
        mysql $USER < testdata.sql
        backupAPI

6)  Return to your desktop machine and pull all the changes


# WORKING WITH WEB RESOURCES:

1)  Everything inside `~/api/web` will be publicly published as is
2)  If not, the `.htaccess` sets a redirect to our API


# WORKING WITH PHP:

1)  Define your PHP code inside `api/src`.
2)  `~/api/src/main.php` defines the sample routes
3)  `~/api/src/API.php` defines a sample basic API routes
4)  `~/api/src/Model` will be updated by PropelORM on schema changes, but you can modify the generated classes



# WORKING WITH MySQL:

Enter the MySQL console from terminal. No credentials needed as per `~/.my.cnf`:

    mysql dam2tXX

Or simply:

    mysql $USER



# WORKING WITH PROPEL ORM:

1)  Define your DB schema at api/model/schemas/model.schema.xml
3)  You can create a collection of ".schema.xml" files in that directory
4)  From the server Linux console execute "srvUpdateSchema"
5)  Remember to pull the PHP code changes from the server!!!


# NOTES:

1)  You also can do files & DB backups from terminal:

        backupAPI

    And recover from a Git repo located at:

        /home/dam2tXX/git/api_files.git

2)  Never modify the cloned DB & FILES repo from a development machine: always synchronize FROM server TO desktop.
