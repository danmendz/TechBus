<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admiinistrador1',
                'surnames' => 'Mendez',
                'phone' => '22222222',
                'type' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
            ],
            [
                'name' => 'Cliente1',
                'surnames' => 'Mendez',
                'phone' => '22222222',
                'type' => 'cliente',
                'email' => 'cliente@gmail.com',
                'password' => 'cliente123',
            ],
        ]);
    }
}
