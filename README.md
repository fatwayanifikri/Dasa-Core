# Introduction
This is default template for projects by __pak Shandy__, built using:

- php 7.1
- Laravel 5.7
	- [CRUDBOOSTER 5.4.22](http://crudbooster.com/doc/5.3/installation)
	- [gazsp/Baum 1.1](https://github.com/gazsp/baum)
- MariaDB 10.3

## Setup for different projects

- Put all files in a folder
- Open file vendor/laravel/framework/src/Illuminate/Database/Schema/Blueprint.php
	- Search for method timestamp
	- Make sure it looks like this
	```
	public function timestamps($precision = 0)
    {
        $this->timestamp('created_at', $precision)->nullable();
        $this->unsignedBigInteger('created_by')->nullable();

        $this->timestamp('updated_at', $precision)->nullable();
        $this->unsignedBigInteger('updated_by')->nullable();

        $this->timestamp('deleted_at', $precision)->nullable();
        $this->unsignedBigInteger('deleted_by')->nullable();

        $this->engine = 'InnoDB';
        $this->collation = 'utf8mb4_unicode_ci';
        $this->charset = 'utf8mb4';
    }
	```
- Setup Database
	- Change database configuration in .env file
	- Run php artisan migrate
	- Run php artisan db:seed
	- Run the following query on your database
		```
		ALTER TABLE cms_apicustom CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_apicustom ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_apikey CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_apikey ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_dashboard CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_dashboard ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_email_queues CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_email_queues ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_email_templates CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_email_templates ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_logs CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_logs ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_menus CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_menus ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_menus_privileges CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_menus_privileges ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_moduls CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_moduls ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_notifications CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_notifications ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_privileges CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_privileges ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_privileges_roles CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_privileges_roles ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_settings CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_settings ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_statistic_components CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_statistic_components ALTER COLUMN id SET DEFAULT uuid_short();
		ALTER TABLE cms_statistics CHANGE id id BIGINT(20) UNSIGNED NOT NULL;
		ALTER TABLE cms_statistics ALTER COLUMN id SET DEFAULT uuid_short();
		```
- Change session settings
	- Generate UUID4 using [UUID Generator](https://www.uuidgenerator.net/version4)
	- Convert generated UUID to Base64 using [Base64 Guru](https://base64.guru/converter/encode/hex)
	- Open config/session.php
	- Replace "master_zIuMcX5pSaWjwBewov" with your "APPNAME_Base64_UUID"
- Change Application Key
	- Open Command Prompt
	- Navigate to project folder
	- Run "php artisan key:generate"

## Login

- username: admin@crudbooster.com
- password: 123456

## Good Reading

- [Laravel 5.7](https://laravel.com/docs/5.7/)
- [CRUDBOOSER](http://crudbooster.com/doc/5.3/installation)