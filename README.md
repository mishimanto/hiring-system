# Installation Instructions

```bash
1. Clone the repository:  
git clone <https://github.com/sardarit-bd/hiring-system>
cd hiring-system

2. Install dependencies:
composer install

3. Copy .env.example → .env and update database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_portal
DB_USERNAME=root
DB_PASSWORD=

4. Generate Key:
php artisan key:generate

5. Run migrations and seeders:
php artisan migrate 
php artisan db:seed 

6. Run storage link:
php artisan storage:link 

7.Run the development server:
php artisan serve

8. Access:
http://localhost:8000
