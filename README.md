## Laravel Task - Cyber-Duck

* The Deliverables:
    - [x] Basic Laravel Auth: ability to log in as administrator
    - [x] Use database seeds to create first user with email admin@admin.com and password “password”
    - [x] CRUD funcXonality (Create / Read / Update / Delete) for two menu items: Companies and Employees.
    - [x] Companies DB table consists of these fields: Name (required), email, logo (minimum 100×100), website
    - [x] Employees DB table consists of these fields: First name (required), last name (required), Company (foreign key to Companies), email, phone
    - [x] Use database migrations to create those schemas above
    - [x] Store companies’ logos in storage/app/public folder and make them accessible from public
    - [x] Use basic Laravel resource controllers with default methods – index, create, store etc.
    - [x] Use Laravel’s validation function, using Request classes
    - [x] Use Laravel’s pagination for showing Companies/Employees list, 10 entries per page
    - [x] Use Laravel make:auth as default Bootstrap-based design theme, but remove ability to register

    - PS: For this task, as agreed with Tara, I didn't use admin LTE.
    - PS2: For Authentication in Laravel 8, I choose Laravel Breeze, removing the ability to register.

* New paths for the structure
    - app
        - Contracts: Interfaces
        - Helpers: Auxiliary classes
        - Providers
            - ContractServiceProvider.php: Interfaces Bind
        - Services: Layer between Controller and Model (Business)

* Used Stack:
    - Ubuntu 20.04
    - PHP 8.0.2
    - MySQL
    - Laravel 8.12
    - Laravel Breeze (Authentication)
    - PHPUnit with SQLite3

* Instalation:
    - Create .env file;
    - Run: composer install
    - Run: composer install
    - Run: npm install && npm run dev
    - Run: php artisan migrate
    - Run: php artisan db:seed
    - To create a symbolic link in storage path: php artisan storage:link

* User Data Login:
    - Email: admin@admin.com
    - Password: password

* Get Routes:
    - Authentication:
        - Login: /login
    - Companies:
        - List: /companies
        - Create: /companies/create
        - Edit: /companies/edit/{id}
    - Employees:
        - List: /employees
        - Create: /employees/create
        - Edit: /employees/edit/{id}

* Post Routes:
    - Authentication:
        - Login: /login
        - Logout: /logout
    - Companies:
        - Create: /companies/create
    - Employees:
        - Create: /employees/create

* Patch Routes:
    - Companies:
        - Edit: /companies/edit/{id}
    - Employees:
        - Edit: /employees/edit/{id}

* Delete Routes:
    - Companies:
        - Create: /companies/remove/{id}
    - Employees:
        - Create: /employees/remove/{id}


### Thank You!