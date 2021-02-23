# Cochi CRM

Stable: v0.3

Cochi CRM – Cochimetl Customer Relationship Management.

## Demo:

[Cochi CRM Live Demo](https://admin-prospectos.demos.adlnetworks.com)

* Login
    - Admin 
        * URL: [/admin/login](https://admin-prospectos.demos.adlnetworks.com/admin/login)
        * User: `admin@adlnetworks.com`.
	    * Password: `password`.
	
### SET UP
* Requirements (Already covered with Docker deployment)
	1. Apache/2.4.27 or greater.
	2. MySQL 5.7 or greater.
	3. PHP/7.2.24 or greater.

* Deploy with Docker (Linux/Debian, Apache, MySQL, PHP)
    1. Run `docker-compose up -d`.
        [Install Docker Compose](https://docs.docker.com/compose/install/).
    2. Look for PHP/Apache Container ID with `docker ps`.
    3. Bash for the next steps => App configuration
        with `docker exec -it {PHP/Apache Container ID} bash`.
  
* App Configuration
    1. Add host `cochi-crm.localhost`,
        	see [Edit hosts](https://dinahosting.com/ayuda/como-modificar-el-fichero-hosts).        	
    2. Create `.env` file from `example.env` and set it.
	3. Set `db` instead `localhost` in `.env` while using Docker.
	4. Give Folder permissions:	
	    ```
	    sudo chown -R $USER:www-data storage;
        chmod -R 775 storage;
        sudo chown -R $USER:www-data bootstrap/cache;
        chmod -R 775 bootstrap/cache;
	    ```
	7. Import database from `database/updates/*.sql` into `root_cochi` DB
        with `root` user, at `localhost` host, `33063` port.
    8. Set `APP_KEY=base64:Z/P5j1VV/3peijg/WLWTEz5rU6JHcUdeb0RiIV8Tp/0=` at `.env`.     	
	9. Run `composer install`.
	10. Run `php artisan storage:link`. 
	11. Run `php artisan migrate`. 	

* Load Fake Data (For Development and testing)
    1. Copy and merge content from `fake-data/public` to `storage/app/public`.
    2. Import database from `fake-data/*.sql` into `root_cochi` DB
            with `root` user, at `localhost` host, `33063` port.
	
* App Production	
	1. Set Webhook at Picky Assit
	`http://cochi-crm.localhost/api/prospectos-webhook?assigned_to=1`.
	Where assigned_to is the optional `users.id`. 
	2. Setup cronjob:
		```
		* * * * * cd /var/www/cochi-crm.localhost && php artisan schedule:run >> /dev/null 2>&1
		```
* App Settings 
    1. Browse [/admin/settings](http://cochi-crm.localhost/admin/settings).
* Create Admin User	
    Create Admin User:
    
    ```
    php artisan create-admin-user --user={email-here}
    ```
    
    Example:
    ```
    php artisan create-admin-user --user=admin@adlnetworks.com	
    ```
* Browse at [cochi-crm.localhost](http://cochi-crm.localhost).

* Voyager Back Office at [cochi-crm.localhost/admin](http://cochi-crm.localhost/admin).
#### App Commands

Manual cron run
```
php artisan schedule:run >> /dev/null 2>&1
```

Distribute Leads to any promotor with equity
```
php artisan equi-distribute-leads
```

Reasign unnatended lead in step 1, to any promotor
```
php artisan reasign-unfollowed-leads --seguimiento=1-2 --to=any_promotor
```

#### Docker Compose Cheat Sheet

Safe Shut Down
```
docker-compose down
```
Install recent added PHP or OS libraries:
```
docker-compose up -d --force-recreate --build
```  

### CONTRIBUTION: Guidelines & Documentation

* Database Key Fields, tables and or values:

	1. `users.email`: Users email.

* Git :
    [Gitflow](http://nvie.com/posts/a-successful-git-branching-model).
* Deploy: 
    [Docker Compose](https://docs.docker.com/compose/reference/up)
* Back End:
    [Laravel 6.x](https://laravel.com/docs/6.x),
    [Laravel Voyager](https://docs.laravelvoyager.com).
* Front End:
    [Admin LTE](https://adminlte.io/),
    [Bootstrap 4](https://getbootstrap.com/docs/4.0/getting-started/introduction),
    [Laravel Admin LTE](https://github.com/jeroennoten/Laravel-AdminLTE), 
    [Font Awesome](https://fontawesome.com/icons?d=gallery&m=free).

***

2020 [ADL NETWORKS](https://adlnetworks.com)
