<h1>SISYOURFILE</h1>
<h3>REQUIRED<h3>
php ^7.4 || ^8.0 <br>
mysql >= 8.0.33<br>
composer<br>

<h3>INSTALL</h3>

Fill in your configuration the <b>.env</b> file. <br>


Run the <b>composer install</b> command. <br>

Run the <b>php spark migrate</b> command  to generate the database tables.<br>

Run the <b>php spark db: seed UserSeeder</b> command
to create the master user<br>

<b>User: </b><i>admin@admin.com</i><br>
<b>Password: </b><i>admin</i>

