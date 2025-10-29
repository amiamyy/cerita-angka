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
        User::updateOrCreate([
            'email' => 'admin@bps.go.id',
        ], [
            'name' => 'Admin BPS Bangkalan',
            'password' => Hash::make('password123'),
            'role' => 'superadmin'
        ]);

        echo "✓ Admin user created/updated successfully!\n";
        echo "  Email: admin@bps.go.id\n";
        echo "  Password: password123\n";
        echo "⚠ Please change the password after first login!\n";
    }
}
