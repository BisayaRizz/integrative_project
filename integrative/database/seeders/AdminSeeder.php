<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rizaldo Vienes Inghug',
            'email' => 'rv.inghug@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}

?>
