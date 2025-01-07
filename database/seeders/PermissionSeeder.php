<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolePermissions;
use App\Models\Permissions;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            [
                'module' => "Dashboard",
                'children' => [],
            ],
            [
                'module' => "Orders",
                'children' => [
                    [
                        'module' => "All Orders",
                        'children' => [
                            [
                                'module' => "View Order Details",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Order Status",
                                'children' => [],
                            ],
                            [
                                'module' => "Generate Documents",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Orders",
                                'children' => [],
                            ],
                        ],
                    ],
                    [
                        'module' => "Return Orders",
                        'children' => [
                            [
                                'module' => "Approve Returns",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Return Orders",
                                'children' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'module' => "Products",
                'children' => [
                    [
                        'module' => "All Products",
                        'children' => [
                            [
                                'module' => "Create Product",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Product",
                                'children' => [],
                            ],
                            [
                                'module' => "Delete Product",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Products",
                                'children' => [],
                            ],
                        ],
                    ],
                    [
                        'module' => "Category",
                        'children' => [
                            [
                                'module' => "Create Category",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Category",
                                'children' => [],
                            ],
                            [
                                'module' => "Delete Category",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Category",
                                'children' => [],
                            ],
                        ],
                    ],
                    [
                        'module' => "Tags",
                        'children' => [
                            [
                                'module' => "Create Tag",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Tag",
                                'children' => [],
                            ],
                            [
                                'module' => "Delete Tag",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Tag",
                                'children' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'module' => "Customers",
                'children' => [
                    [
                        'module' => "Update Customer",
                        'children' => [],
                    ],
                    [
                        'module' => "Ban Customer",
                        'children' => [],
                    ],
                    [
                        'module' => "Export Customers",
                        'children' => [],
                    ],
                ],
            ],
            [
                'module' => "Promotion",
                'children' => [
                    [
                        'module' => "Vouchers",
                        'children' => [
                            [
                                'module' => "Create Voucher",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Voucher",
                                'children' => [],
                            ],
                            [
                                'module' => "Delete Voucher",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Vouchers",
                                'children' => [],
                            ],
                        ],
                    ],
                    [
                        'module' => "Discounts",
                        'children' => [
                            [
                                'module' => "Create Discount",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Discount",
                                'children' => [],
                            ],
                            [
                                'module' => "Delete Discount",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Discounts",
                                'children' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'module' => "Content Management",
                'children' => [
                    [
                        'module' => "Media Management",
                        'children' => [
                            [
                                'module' => "Create Media Component",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Media Component",
                                'children' => [],
                            ],
                            [
                                'module' => "Delete Media Component",
                                'children' => [],
                            ],
                            [
                                'module' => "Show/Hide Media Component",
                                'children' => [],
                            ],
                            [
                                'module' => "Export Media Component",
                                'children' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'module' => "Report and Analytics",
                'children' => [
                    [
                        'module' => "Sales Report",
                        'children' => []
                    ],
                    [
                        'module' => "Customer Insights",
                        'children' => []
                    ],
                    [
                        'module' => "Product Performance",
                        'children' => []
                    ],
                ]
            ],
            [
                'module' => "Settings",
                'children' => [
                    [
                        'module' => "General Settings",
                        'children' => [
                            [
                                'module' => "Update Company Profile",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Social Media",
                                'children' => [],
                            ],
                            [
                                'module' => "Manage Maintenance",
                                'children' => [],
                            ],
                        ],
                    ],
                    [
                        'module' => "Payment Methods",
                        'children' => [
                            [
                                'module' => "Create Payment Method",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Payment Method",
                                'children' => [],
                            ]
                        ],
                    ],
                    [
                        'module' => "Shipping Options",
                        'children' => [
                            [
                                'module' => "Create Shipping Option",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Shipping Option",
                                'children' => [],
                            ]
                        ],
                    ],
                ],
            ],
            [
                'module' => "User Management",
                'children' => [
                    [
                        'module' => "Users",
                        'children' => [
                            [
                                'module' => "Create User",
                                'children' => [],
                            ],
                            [
                                'module' => "Update User",
                                'children' => [],
                            ],
                            [
                                'module' => "Reset Password",
                                'children' => [],
                            ],
                        ],
                    ],
                    [
                        'module' => "Role Settings",
                        'children' => [
                            [
                                'module' => "Create Role",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Role",
                                'children' => [],
                            ],
                            [
                                'module' => "Assign Permission",
                                'children' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'module' => "Help Center",
                'children' => [
                    [
                        'module' => "Support Tickets",
                        'children' => [
                            [
                                'module' => "Assign Ticket",
                                'children' => [],
                            ],
                            [
                                'module' => "Update Ticket Status",
                                'children' => [],
                            ],
                            [
                                'module' => "View Ticket Information",
                                'children' => [],
                            ]
                        ],
                    ],
                    [
                        'module' => "FAQs",
                        'children' => [
                            [
                                'module' => "Create FAQs",
                                'children' => [],
                            ],
                            [
                                'module' => "Update FAQs",
                                'children' => [],
                            ],
                            [
                                'module' => "Delete FAQs",
                                'children' => [],
                            ],
                        ],
                    ]
                ],
            ],
            [
                'module' => "Account Settings",
                'children' => []
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permissions::truncate();
        RolePermissions::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($permissions as $permission) {
            $this->savePermissions($permission);
        }

    }

    public function savePermissions($permission, $parentId = null)
    {
        $data['module'] = $permission['module'];
        $data['slug'] = Str::slug($permission['module']);
        $data['parent_id'] = $parentId;

        $result = Permissions::create($data);

        if (!empty($permission['children'])) {
            foreach ($permission['children'] as $child) {
                $this->savePermissions($child, $result->id);
            }
        }

    }
}
