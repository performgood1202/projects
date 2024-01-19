## Basic setup
	-- composer install
	-- php artisan jwt:secret
	-- npm install && npm run dev
	-- npm run watch

	> allow 777 permissions to storage.
	> add database details.

	-- php artisan migrate
	-- php artisan key:generate
	-- php artisan optimize:clear

	** you can run the view with the help of ( php artisan serve ) or link the project to any dev sub-domain.

## Other Commands.

	> These are the other basic commands for the project as controllers are inside (Api) and models are inside (Models)
	-- php artisan make:controller Api/<name>
	-- php artisan make:model Models/<name> -m   (will create model with migrations.)

