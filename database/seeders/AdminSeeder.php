<?php
// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
       // database/seeders/AdminSeeder.php
User::create([
    'name' => 'Super Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('admin123'),
    'role' => 'admin',
    'status' => 'approved'
]);

    }
}
