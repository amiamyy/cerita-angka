<?php

namespace Database\Seeders;

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
        // Create Super Admin
        User::create([
            'name' => 'Admin BPS Bangkalan',
            'email' => 'admin@bps.go.id',
            'password' => Hash::make('password123'),
            'role' => 'superadmin'
        ]);

        echo "✓ Admin user created successfully!\n";
        echo "  Email: admin@bps.go.id\n";
        echo "  Password: password123\n";
        echo "⚠ Please change the password after first login!\n";
    }
}
