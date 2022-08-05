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
                // Vendors ::
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
                        // Transactions Setting ::
                        'transaction-managment',
                            'currencies',
                                'currency-create',
                                'currency-edit',
                            'units',
                                'unit-create',
                                'unit-edit',
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
            // Admin Department ::
            'admin-department-list',
                'admin-department-managment',
                    'admin-department-create',
                    'admin-department-edit',
                    'admin-department-delete',
            // Orchards Settings ::
            'orchards-list',
                'land-categories',
                    'land-categories-create',
                    'land-categories-edit',
                    'land-categories-delete',
                    'land-categories-delete-all',
                'tree-type',
                    'tree-type-create',
                    'tree-type-edit',
                    'tree-type-delete',
                    'tree-type-delete-all',
                'tree',
                    'tree-create',
                    'tree-edit',
                    'tree-delete',
                    'tree-delete-all',
                'orchard',
                    'orchard-create',
                    'orchard-edit',
                    'orchard-delete',
                    'orchard-delete-all',
            // Protect Houses ::
            'protect-house-list',
                'protect-house',
                'protect-house-create',
                'protect-house-edit',
                'protect-house-delete',
                'protect-house-delete-all',
            // Agri Service ::
            'service-list',
                'agriculture-service',
                    'agriculture-service-create',
                    'agriculture-service-edit',
                    'agriculture-service-delete',
                    'agriculture-service-delete-all',
                'agriculture-tools-service',
                    'agriculture-tools-service-create',
                    'agriculture-tools-service-edit',
                    'agriculture-tools-service-delete',
                    'agriculture-tools-service-delete-all',
                'water-service',
                    'water-service-create',
                    'water-service-edit',
                    'water-service-delete',
                    'water-service-delete-all',
                'farmer-service',
                    'farmer-service-create',
                    'farmer-service-edit',
                    'farmer-service-delete',
                    'farmer-service-delete-all',
            // Precipitation ::
            'precipitation-list',
                'precipitation',
                'precipitation-create',
                'precipitation-edit',
                'precipitation-delete',
                'precipitation-delete-all',
                // Precipitation Graph ::
                'precipitation-graph',
            // Land Area ::
            'land-area-list',
                'land-area',
                'land-area-create',
                'land-area-edit',
                'land-area-delete',
                'land-area-delete-all',
            // Farmer Crop List ::
            'farmer-crop-list',
                'farmer-crop',
                    'farmer-crop-create',
                    'farmer-crop-edit',
                    'farmer-crop-delete',
                    'farmer-crop-delete-all',
                'winter-crops',
                    'winter-crop-create',
                    'winter-crop-edit',
                    'winter-crop-delete',
                    'winter-crop-delete-all',
                'summer-crops',
                    'summer-crop-create',
                    'summer-crop-edit',
                    'summer-crop-delete',
                    'summer-crop-delete-all',
            // Caw & Chicken Projects ::
            'projects-list',
                'caws-project',
                    'caws-project-create',
                    'caws-project-edit',
                    'caws-project-delete',
                    'caws-project-delete-all',
                'chicken-project',
                    'chicken-project-create',
                    'chicken-project-edit',
                    'chicken-project-delete',
                    'chicken-project-delete-all',
            // Bee Managment List ::
            'bee-managment',
                'bee-keepers',
                    'bee-keepers-create',
                    'bee-keepers-edit',
                    'bee-keepers-delete',
                    'bee-keepers-delete-all',
                'bee-disasters',
                    'bee-disasters-create',
                    'bee-disasters-edit',
                    'bee-disasters-delete',
                    'bee-disasters-delete-all',
                'bee-courses',
                    'bee-courses-create',
                    'bee-courses-edit',
                    'bee-courses-delete',
                    'bee-courses-delete-all',
            // Whole Products ::
            'whole-products-managment',
                'whole-sale-products',
                    'whole-sale-products-create',
                    'whole-sale-products-edit',
                    'whole-sale-products-delete',
                    'whole-sale-products-delete-all',
                'whole-sale',
                    'whole-sale-create',
                    'whole-sale-edit',
                    'whole-sale-delete',
                    'whole-sale-delete-all',
                'income-products',
                    'income-products-create',
                    'income-products-edit',
                    'income-products-delete',
                    'income-products-delete-all',
                'outcome-products',
                    'outcome-products-create',
                    'outcome-products-edit',
                    'outcome-products-delete',
                    'outcome-products-delete-all',
            // Blogs & Tags Managment ::
            'blogs-managment',
                'blogs',
                    'blog-create',
                    'blog-edit',
                    'blog-delete',
                    'blog-delete-all',
                'tags',
                    'tag-create',
                    'tag-edit',
                    'tag-delete',
                    'tag-delete-all',
            // Products Managment ::
            'products-managment',
                'products',
                    'product-create',
                    'product-processes',
                        'product-edit',
                        'product-delete',
                    'product-delete-all',
                    'product-stock',
                    'product-change-status',
                    'product-special-price',
                    'product-trushed',
                    'product-restore',
                    'product-trushed-delete',
                    'product-trushed-delete-all',
            // Orders ::
            'orders-managment',
                'orders',
                    'order-processes',
                    'order-show',
                        'order-change-status',
                    'order-invoice-print',
            // Subscribes ::
            'subscribes',
                'subscribe-delete',
                'subscribe-delete-all',
            // Reports ::
            'animal-reports',
                'statistics-report',
                'ship-report-statistics',
                'caw_statistics-report',
                'fish-report-statistics',
                'chicken-report-statistics',
            'horticulture-reports',
                'orchard-report-statistics',
                'protected-house-statistics',
                'protected-house-government-statistics',
                'protected-house-private-statistics',
            'beekeeper-reports',
                'bee-keepers-statistics',
                'bee-keepers-details-statistics',
            'service-reports',
                'farmer-service-statistics',
                'precipitation-statistics',
                'precipitation-details-statistics',
            'planning-reports',
                'land-area-report',
                'land-area-details-report',
                'land-area-state-report',
                'farmer-crop-statistics',
                'income-product-statistics',
                'index-income-product-statistics',
                    'index-income-product-statistics-filter',
                'income-local-product-statistics',
                    'income-local-product-statistics-filter',
                'income-imported-product-statistics',
                    'income-imported-product-statistics-filter',
                'income-iraq-product-statistics',
                    'income-iraq-product-statistics-filter',
                'outcome-product-statistics',
                'index-outcome-products-statistics',
                    'index_outcome_products-statistics-filter',
                'index-outcome-local-products-statistics',
                    'index-outcome-local-products-statistics-filter',
                'index-outcome-imported-products-statistics',
                    'index-outcome-imported-products-statistics-filter',
                'outcome-iraq-products-statistics',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
