# SpaceX assignment
## 0. Before start
> Install the extension for firefox to override the cors policies: [Firefox Cors Plugin](https://addons.mozilla.org/en-US/firefox/addon/access-control-allow-origin/)

> Because i had a problem with CORS i used GET method to /launch/edit. 

----------
## 1.BACKEND

----------

If you are new to php and symfony just first install  [xampp for linux or windows](https://www.apachefriends.org/index.html)
1. [install xampp](https://www.youtube-nocookie.com/embed/h6DEDm7C37A)
2. go to phpmyadmin
3. [create a mysql user](https://docs.phpmyadmin.net/el/latest/privileges.html#creating-a-new-user)
4. give all [permissions](https://docs.phpmyadmin.net/el/latest/privileges.html#assigning-privileges-to-user-for-a-specific-database) to the user.
5. [download](https://getcomposer.org/download/) and install composer
6. [download](https://symfony.com/download) and install symfony/cli


The project have 2 main directories `front` and `back`. The front contains the code for the ReactUI and the back all the backend symfony project.

----------

### Run commands
Install composer packages from the file package.json

>`# composer install `

.env file contains all the [configuration](https://symfony.com/doc/current/doctrine.html#configuring-the-database) for the db. Change them to the new user you created in the db

>`DATABASE_URL="mysql://root:root@127.0.0.1:3306/spacex"`

Create the db.

>`php bin/console doctrine:database:create`

To create the tables for the db you need to apply the [migrations](https://symfony.com/doc/current/doctrine.html#migrations-creating-the-database-tables-schema) that exist in the `/back/migrations` folder.
>`php bin/console doctrine:migrations:migrate`

Fetch the data from the SpaceX api.

>`# php bin/console app:pop_data `

You are ready to run the backend of the app.

>`# symfony server:start `


----------
## 2.FRONTEND

----------
Install [nvm npm and node.js](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm#using-a-node-version-manager-to-install-nodejs-and-npm)

after the installation completed run the command:
> `# cd front`

install all the packages that needed for the Frontend app  
> `# npm install`

run the project
> `# npm start` 



----------

# Thanks for your time.
