
Konfigurasi awal setelah clone github
1.composer install
2.php artisan serve
3.npm run dev
4.php artisan migrate
5.php artisan shield:generate --all  
6.php artisan db:seed --class=AdminUserSeeder 
7.php artisan tinker
8.$user = \App\Models\User::where('email', 'superadmin@test.com')->first();
9.$user->roles;
10.$user->assignRole('super_admin');
11.exit
