<?php
namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
class PermissionTableSeeder extends Seeder {
    public function run() {
        $permissions = [];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
