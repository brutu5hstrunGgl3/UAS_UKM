 code Apps 

 CARA INSTALL 


 Composer install 
Buat halaman .env atau bisa copy cp .env.example .env
 atau bisa buat .env sendiri  di dalam folder yang sudah di clone dengan kode berikut ini 
 APP_NAME=Laravel
 APP_ENV=local
 APP_KEY=
 APP_DEBUG=false
 APP_TIMEZONE=UTC
 APP_URL=

 APP_LOCALE=id
 APP_FALLBACK_LOCALE=en
 APP_FAKER_LOCALE=en_US

 APP_MAINTENANCE_DRIVER=file
 APP_MAINTENANCE_STORE=database

 BCRYPT_ROUNDS=12

 LOG_CHANNEL=stack
 LOG_STACK=single
 LOG_DEPRECATIONS_CHANNEL=null
 LOG_LEVEL=debug

 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE= nama db
 DB_USERNAME= username db
 DB_PASSWORD= password db

 SESSION_DRIVER=database
 SESSION_LIFETIME=120
 SESSION_ENCRYPT=false
 SESSION_PATH=
 SESSION_DOMAIN=null

 BROADCAST_CONNECTION=log
 FILESYSTEM_DISK=local
 QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS= 
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"


 
 setelah itu buat key baru
 php artisan key:generate 
 Create db 
 Migrate 
 php artisan migrate 




 Setelah di koneksikan kemudian migrasi seeder yang telah dibuat 
 php artisan migrate:fresh --seed
 setelah semua sudah termigrasi 
 test running dengan ketik php artisan serve
 akun admin  
 username : komputer77@admin.lms
 pwd      : lms123321




