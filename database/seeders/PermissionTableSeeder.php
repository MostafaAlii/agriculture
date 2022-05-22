<?php
namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
class PermissionTableSeeder extends Seeder {
    public function run() {
        $permissions = [
            // Permissions Widget ::
            // Admins & Moderator ::
            'dashboard',
            'admin',
            'moderators-management',
                'moderator-list',
                    'moderator-create',
                    'moderator-show',
                    'moderator-edit',
                    'moderator-delete',
                    'moderator-delete-all',
                // Farmers ::
                'farmer-list',
                    'farmer-create',
                    'farmer-show',
                    'farmer-edit',
                    'farmer-delete',
                    'farmer-delete-all',
                // Worker ::
                'worker-list',
                    'worker-create',
                    'worker-show',
                    'worker-edit',
                    'worker-delete',
                    'worker-delete-all',
                // {Vendors} ::
                'vendor-list',
                    'vendor-create',
                    'vendor-show',
                    'vendor-edit',
                    'vendor-delete',
                    'vendor-delete-all',    
            // Settings ::
            'settings-managment',
                'settings',
                    'role-list',
                        'role-processes',
                            'role-show', 
                            'role-edit', 
                            'role-delete', 
                        'role-create', 
                        'role-delete-all',
                    'pages',
                        // About Us ::
                        'about-us',
                        // Contact Us ::
                        'contact-us',
                            'contact-replay', 
                            'contact-us-delete', 
                            'send-new-contact-messeage',
                        // Teams ::
                        'team-managment',
                            'team-create',
                            'team-edit',
                            'team-delete',
                            'team-delete-all',
                        // Client Review ::
                        'client-review',
                            'client-review-create',
                            'client-review-edit',
                            'client-review-delete',
                            'client-review-delete-all',
                        // Sliders ::
                        'slider-managment',
                            'photo-slider-create',
                            'photo-slider-edit',
                            'photo-slider-delete',
                            'photo-slider-delete-all',
                        // Brands ::
                        'brands-managment',
                            'brands-create',
                            'brands-edit',
                            'brands-delete',
                            'brands-delete-all',
            //Country List ::
            'countries-list',
                // Country ::
                'country-managment',
                    'country-create',
                    'country-edit',
                    'country-delete',
                    'country-delete-all',
                // Proviences ::
                'provience-managment',
                    'provience-create',
                    'provience-edit',
                    'provience-delete',
                    'provience-delete-all',
                // Areas ::
                'area-managment',
                    'area-create',
                    'area-edit',
                    'area-delete',
                    'area-delete-all',
                    'area-filter-operation',
                // States ::
                'state-managment',
                    'state-create',
                    'state-edit',
                    'state-delete',
                    'state-delete-all',
                // Villages ::
                'village-managment',
                    'village-create',
                    'village-edit',
                    'village-delete',
                    'village-delete-all',
            // Departments ::
            'department-list',
                'department-managment',
                    'department-create',
                    'department-edit',
                    'department-delete',
                    'department-delete-all',
            // Categories ::
            'category-list',
                'category-managment',
                    'category-create',
                    'category-edit',
                    'category-delete',
                    'category-delete-all',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
