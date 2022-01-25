<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'role_id' => '2',
            'dni' => '12345678A',
            'name' => 'Administrador',
            'email' => 'admin@gimnasio.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'weight' => '65',
            'height' => '170',
            'birthdate' => '1990-01-01',
            'gender' => 'male'
        ]);
    }
}
