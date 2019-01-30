INIT:

1) Clone the source code repo:

    git clone dam2tXX@stucom.flx.cat:/home/dam2tXX/git/api_src.git 

2) Update the following files with your username (and password):

    ~/api/web/.htaccess
    ~/api/composer.json
    ~/api/model/propel.yml

3) Log in the server and modify the ~/.my.cnf with your credentials

4) Get the modifications of code and prepare the environment:

    cd ~/api
    git pull
    composer update
    srvUpdateSchema

5) Return to your desktop machine and pull the changes


PHP:

1) Define your PHP code inside api/src.
2) api/src/main.php defines the sample routes
3) api/src/API.php defines a sample basic API routes
4) api/src/Model will be updated by PropelOrm on schema change, but you can modify the generated classes

DATABASE (PROPELORM):

1) Put your DB credentials at api/model/propel.yml
2) Define your DB schema at api/model/schemas/model.schema.xml
3) You can create a collection of ".schema.xml" files in that directory
4) From the server Linux console execute "srvUpdateSchema".
5) Remember to pull the PHP code changes from the server.
6) Synchronize the local files and DB if you are executing also from the localhost!

