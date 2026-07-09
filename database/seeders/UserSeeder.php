<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Daniel',
                'surnames' => 'Mendez',
                'phone' => '522216075444',
                'type' => 'admin',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Nancy',
                'surnames' => 'Paleta',
                'phone' => '522226348266',
                'type' => 'cliente',
                'email' => 'cliente1@gmail.com',
                'password' => Hash::make('cliente123'),
            ],
            [
                'name' => 'Denisse',
                'surnames' => 'Patiño',
                'phone' => '528444975248',
                'type' => 'admin',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Emili',
                'surnames' => 'Amaro',
                'phone' => '522212326923',
                'type' => 'cliente',
                'email' => 'cliente2@gmail.com',
                'password' => Hash::make('cliente123'),
            ],
        ]);
    }
}
