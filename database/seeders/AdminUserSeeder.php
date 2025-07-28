<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles (check if they exist first)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Create permissions (check if they exist first)
        $permissions = [
            'view_dashboard',
            'manage_users',
            'manage_products',
            'manage_categories',
            'manage_brands',
            'manage_orders',
            'view_reports'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to admin role
        $adminRole->givePermissionTo(Permission::all());

        // Create admin user (check if exists first)
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        // Assign admin role to the user
        $admin->assignRole('admin');

        $this->command->info('Admin user created successfully:');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password123');
    }
}
