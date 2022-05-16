<?php
namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
class PermissionTableSeeder extends Seeder {
    public function run() {
        $permissions = [
            // Permissions Widget ::
            'roles-management',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'admin','name' => $permission]);
        }
    }
}
