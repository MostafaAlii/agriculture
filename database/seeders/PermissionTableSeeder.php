<?php
namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
class PermissionTableSeeder extends Seeder {
    public function run() {
        $permissions = [
            // Permissions Widget ::
            // Admins & Moderator ::
            'admin',
            'moderators-management',
                'moderator-list',
                'moderator-create',
                'moderator-edit',
                'moderator-delete',
                'moderator-delete-all',
                // Farmers ::
                'farmer-list',
                'farmer-create',
                'farmer-edit',
                'farmer-delete',
                'farmer-delete-all',
                // Worker ::
                'worker-list',
                'worker-create',
                'worker-edit',
                'worker-delete',
                'worker-delete-all',
                // {Vendors} ::
                'vendor-list',
                'vendor-create',
                'vendor-edit',
                'vendor-delete',
                'vendor-delete-all',
            
            // Settings ::
            'settings-managment',
                'setting-list',
                // Sliders ::
                'slider-list',
                'slider-create',
                'slider-edit',
                'slider-delete',
                'slider-delete-all',
                // Brands ::
                'brand-list',
                'brand-create',
                'brand-edit',
                'brand-delete',
                'brand-delete-all',
                // Roles ::
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
                'role-delete-all',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
